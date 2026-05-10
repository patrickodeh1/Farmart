<?php

namespace Botble\RezgoConnector\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\RezgoConnector\Http\Requests\UpdateRezgoSettingsRequest;
use Botble\RezgoConnector\Models\{RezgoSubmission, RezgoProductMapping, RezgoLog};
use Botble\RezgoConnector\Services\{RezgoSettingsService, RezgoApiService, ExternalDatabaseSyncService, ExternalDatabaseConfigService};
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse, JsonResponse};
use Botble\Ecommerce\Models\Product;

class RezgoConnectorController extends BaseController
{
    private RezgoSettingsService $settings;
    private RezgoApiService $api;
    private ExternalDatabaseSyncService $externalSync;

    public function __construct(RezgoSettingsService $settings, RezgoApiService $api, ExternalDatabaseSyncService $externalSync)
    {
        $this->settings     = $settings;
        $this->api          = $api;
        $this->externalSync = $externalSync;
    }

    public function index(): View
    {
        return view('rezgo::admin.settings', [
            'settings'          => $this->settings->all(),
            'decrypted_cid'     => $this->settings->getCid(),
            'decrypted_api_key' => $this->settings->getApiKey(),
            'submissionsCount'  => RezgoSubmission::count(),
            'successCount'      => RezgoSubmission::where('status', 'success')->count(),
            'failedCount'       => RezgoSubmission::where('status', 'failed')->count(),
            'mappingsCount'     => RezgoProductMapping::where('is_active', true)->count(),
            'recentLogs'        => RezgoLog::latest()->limit(10)->get(),
        ]);
    }

    public function updateSettings(UpdateRezgoSettingsRequest $request): RedirectResponse
    {
        $this->settings->setCid($request->input('rezgo_cid'));
        $this->settings->setApiKey($request->input('rezgo_api_key'));
        $this->settings->set('default_passenger_type', $request->input('default_passenger_type', 'adult'));
        $this->settings->set('booking_date_offset', (int)$request->input('booking_date_offset', 1));
        $this->settings->set('sync_enabled', (bool)$request->input('sync_enabled', false));

        return back()->with('success', __('Settings updated successfully'));
    }

    public function submissions(): View
    {
        $submissions = RezgoSubmission::with('order')->latest()->paginate(20);
        return view('rezgo::admin.submissions', ['submissions' => $submissions]);
    }

    public function submissionDetail(int $id): View
    {
        $submission = RezgoSubmission::with('order')->findOrFail($id);
        return view('rezgo::admin.submission-detail', ['submission' => $submission]);
    }

    public function showSubmitOrderForm(): View
    {
        $orderIds   = \DB::table('ec_orders')->orderBy('id', 'desc')->limit(100)->pluck('id');
        $ordersData = [];

        foreach ($orderIds as $orderId) {
            $order    = \DB::table('ec_orders')->where('id', $orderId)->first();
            $customer = \DB::table('ec_customers')->find($order->user_id);
            $products = \DB::table('ec_order_product')->where('order_id', $orderId)->get();
            $orderedProducts = [];
            $orderTotal = 0;

            foreach ($products as $product) {
                $productModel = \Botble\Ecommerce\Models\Product::find($product->product_id);
                $mapping     = \DB::table('rezgo_product_mappings')
                    ->where('product_id', $product->product_id)
                    ->where('is_active', true)
                    ->first();
                
                // Use rezgo_price if mapped, otherwise use product price
                $pricePerItem = $mapping ? $mapping->rezgo_price : ($productModel ? $productModel->price : 0);
                $lineTotal = $pricePerItem * ($product->quantity ?? 1);
                $orderTotal += $lineTotal;
                
                $orderedProducts[] = [
                    'product_id'     => $product->product_id,
                    'product_name'   => $productModel ? $productModel->name : 'Unknown',
                    'product_price'  => $productModel ? $productModel->price : 0,
                    'quantity'       => $product->quantity ?? 1,
                    'rezgo_uid'      => $mapping ? $mapping->rezgo_uid : null,
                    'rezgo_tour'     => $mapping ? $mapping->rezgo_uid : null,
                    'rezgo_title'    => $mapping ? $mapping->rezgo_title : null,
                    'rezgo_price'    => $mapping ? $mapping->rezgo_price : 0,
                    'passenger_type' => $mapping ? $mapping->passenger_type : null,
                    'mapped'         => $mapping ? true : false,
                    'availability'   => 0,
                ];
            }

            $ordersData[] = [
                'id'            => $orderId,
                'user_id'       => $order->user_id,
                'customer_name' => $customer ? $customer->name : null,
                'total'         => $orderTotal > 0 ? $orderTotal : ($order->total ?? 0),
                'created_at'    => $order->created_at ?? null,
                'products'      => $orderedProducts,
            ];
        }

        $products             = \DB::table('ec_products')->orderBy('name')->get();
        $availabilityResponse = $this->api->searchInventory();
        $tourAvailability     = [];

        if ($availabilityResponse['success'] && isset($availabilityResponse['data']['item'])) {
            $items = $availabilityResponse['data']['item'];
            if (!is_array($items) || !isset($items[0])) {
                $items = [$items];
            }
            foreach ($items as $item) {
                $uid = $item['uid'] ?? null;
                if ($uid) {
                    $tourAvailability[$uid] = [
                        'name' => $item['name'] ?? $item['item'] ?? $uid,
                        'availability' => $item['available'] ?? $item['availability'] ?? 0,
                    ];
                }
            }
        }

        return view('rezgo::admin.submit-order', [
            'orders'           => $ordersData,
            'products'         => $products,
            'tourAvailability' => $tourAvailability,
        ]);
    }

    // FIX: paginator now passed to view; display_name normalised for both 'name' and 'item' fields
    public function productMappings(): View
    {
        $mappings            = RezgoProductMapping::with('product')->paginate(20);
        $products            = \DB::table('ec_products')->orderBy('name')->get();
        $rezgoTours          = [];
        $totalInventoryCount = 0;
        $rezgoPaginator      = null;
        $inventoryError      = null;

        try {
            $inventoryResponse = $this->api->searchInventory();

            if ($inventoryResponse['success'] && isset($inventoryResponse['data']['item'])) {
                $items = $inventoryResponse['data']['item'];
                // Normalize to array
                if (!is_array($items) || !isset($items[0])) {
                    $items = [$items];
                }

                $totalInventoryCount = count($items);
                // Paginate in view (approximate)
                $perPage = 15;
                $slice   = array_slice($items, 0, $perPage);

                // Normalize display_name for each
                foreach ($slice as &$item) {
                    $item['display_name'] = $item['name'] ?? $item['item'] ?? $item['uid'] ?? 'Unknown';
                }

                $rezgoTours = $slice;

            } elseif (!$inventoryResponse['success']) {
                $inventoryError = $inventoryResponse['error'] ?? 'Unknown API error';
                RezgoLog::error('product_mappings', null, 'Inventory fetch failed: ' . $inventoryError);
            }
        } catch (\Exception $e) {
            $inventoryError = $e->getMessage();
            RezgoLog::error('product_mappings', null, 'Exception fetching inventory: ' . $e->getMessage());
        }

        return view('rezgo::admin.product-mappings', [
            'mappings'            => $mappings,
            'products'            => $products,
            'rezgoTours'          => $rezgoTours,
            'totalInventoryCount' => $totalInventoryCount,
               'rezgoPaginator'      => $rezgoPaginator,
            'inventoryError'      => $inventoryError,
        ]);
    }

    public function saveProductMapping(\Illuminate\Http\Request $request): RedirectResponse
    {
        $request->validate([
            'product_id'     => 'required|exists:ec_products,id',
            'rezgo_uid'      => 'required|string',
            'rezgo_title'    => 'nullable|string',
            'passenger_type' => 'required|in:adult,child,senior',
        ]);

        if ($request->filled('mapping_id')) {
            $mapping = RezgoProductMapping::findOrFail($request->mapping_id);
            $mapping->update([
                'product_id'     => $request->product_id,
                'rezgo_uid'      => $request->rezgo_uid,
                'rezgo_title'    => $request->rezgo_title,
                'passenger_type' => $request->passenger_type,
                'is_active'      => true,
            ]);
            $mappingData = $mapping->toArray();
        } else {
            $mapping = RezgoProductMapping::updateOrCreate(
                ['product_id' => $request->product_id],
                [
                    'rezgo_uid'      => $request->rezgo_uid,
                    'rezgo_title'    => $request->rezgo_title,
                    'passenger_type' => $request->passenger_type,
                    'is_active'      => true,
                ]
            );
            $mappingData = $mapping->toArray();
        }

        // FIX: use config() not env()
        if (config('rezgo.rezgo.external_sync.enabled', false)) {
            $this->externalSync->syncMappingToExternal($mappingData);
        }

        return back()->with('success', __('Product mapping saved successfully'));
    }

    public function deleteProductMapping(int $id): RedirectResponse
    {
        $mapping  = RezgoProductMapping::findOrFail($id);
        $rezgoUid = $mapping->rezgo_uid;
        $mapping->delete();

        if (config('rezgo.rezgo.external_sync.enabled', false)) {
            $this->externalSync->deleteMappingFromExternal($rezgoUid);
        }

        return back()->with('success', __('Product mapping deleted'));
    }

    public function logs(): View
    {
        $logs = RezgoLog::latest()->paginate(50);
        return view('rezgo::admin.logs', ['logs' => $logs]);
    }

    public function testConnection(): RedirectResponse
    {
        if (!$this->settings->isConfigured()) {
            return back()->with('error', __('Rezgo API not configured'));
        }
        $response = $this->api->getCompanyInfo();
        if ($response['success']) {
            $companyName = $response['data']['company_name'] ?? 'Unknown';
            return back()->with('success', __("Connection successful! Company: {$companyName}"));
        }
        return back()->with('error', __('Connection failed: ' . $response['error']));
    }

    public function syncInventory(): RedirectResponse
    {
        if (!$this->settings->isConfigured()) {
            return back()->with('error', __('Rezgo API not configured'));
        }
        $response = $this->api->searchInventory();
        if (!$response['success']) {
            return back()->with('error', __('Failed to sync inventory: ' . $response['error']));
        }
        RezgoLog::sync('sync_inventory', null, 'Inventory sync completed', $response['data']);
        return back()->with('success', __('Inventory synced successfully'));
    }

    public function submitOrder(\Illuminate\Http\Request $request): RedirectResponse
    {
        $orderId  = $request->input('order_id');
        $tourDate = $request->input('tour_date');

        if (!$orderId)  return back()->with('error', __('Order ID required'));
        if (!$tourDate) return back()->with('error', __('Tour date required'));

        try {
            $bookingDate = Carbon::createFromFormat('Y-m-d', $tourDate);
            if ($bookingDate->isPast()) {
                return back()->with('error', __('Tour date must be in the future'));
            }
        } catch (\Exception $e) {
            return back()->with('error', __('Invalid tour date format'));
        }

        $order = \DB::table('ec_orders')->where('id', $orderId)->first();
        if (!$order) return back()->with('error', __('Order not found'));

        $orderProducts = \DB::table('ec_order_product')->where('order_id', $orderId)->get();
        if ($orderProducts->isEmpty()) return back()->with('error', __('Order has no products'));

        $customer = \DB::table('ec_customers')->find($order->user_id);
        if (!$customer) return back()->with('error', __('Customer not found'));

        $adultsCount = $childrenCount = $seniorsCount = 0;
        $tourUid = null;

        foreach ($orderProducts as $product) {
            $mapping = \DB::table('rezgo_product_mappings')
                ->where('product_id', $product->product_id)
                ->where('is_active', true)
                ->first();

            if (!$mapping) {
                return back()->with('error', __("Product {$product->product_id} has no Rezgo mapping"));
            }

            if (!$tourUid) $tourUid = $mapping->rezgo_uid;

            $qty = (int)($product->qty ?? 1);
            switch ($mapping->passenger_type) {
                case 'child':
                    $childrenCount += $qty;
                    break;
                case 'senior':
                    $seniorsCount += $qty;
                    break;
                default:
                    $adultsCount += $qty;
                    break;
            }
        }

        $bookingData = [
            'order_id'           => $orderId,
            'book'               => $tourUid,
            'date'               => $tourDate,
            'adult_num'          => $adultsCount,
            'child_num'          => $childrenCount,
            'senior_num'         => $seniorsCount,
            'tour_first_name'    => $customer->name ?? 'Customer',
            'tour_last_name'     => 'Order-' . $orderId,
            'tour_email_address' => $customer->email ?? 'noemail@test.com',
            'tour_phone_number'  => $customer->phone ?? '555-0000',
            'tour_address_1'     => $customer->address ?? '123 Main St',
            'tour_city'          => $customer->city ?? 'Orlando',
            'tour_stateprov'     => $customer->province ?? 'FL',
            'tour_country'       => $customer->country ?? 'US',
            'tour_postal_code'   => $customer->zip_code ?? '12345',
            'payment_method'     => 'Credit Cards',
        ];

        $response = $this->api->commitBooking($bookingData);

        if ($response['success']) {
            $transNum = $response['trans_num'] ?? null;
            RezgoSubmission::updateOrCreate(
                ['order_id' => $orderId],
                [
                    'status'           => 'success',
                    'rezgo_booking_id' => $transNum,
                    'http_status'      => 201,
                    'error_message'    => null,
                ]
            );
            return back()->with('success', __("Order submitted to Rezgo successfully! Transaction: {$transNum}"));
        }

        $fullError = ($response['error'] ?? 'Unknown error') . ($response['error_code'] ? ' [' . $response['error_code'] . ']' : '');
        RezgoSubmission::updateOrCreate(
            ['order_id' => $orderId],
            [
                'status'           => 'failed',
                'rezgo_booking_id' => null,
                'http_status'      => $response['status'] ?? 0,
                'error_message'    => $fullError,
            ]
        );
        return back()->with('error', __('Submission failed: ' . $fullError));
    }

    /**
     * FIX: now calls getItemFull() (instruction=item) to get full description,
     * images, and price. Slug generated and made unique. SKU left null.
     * Redirects to product edit page after creation.
     */
    public function importAsDraft(\Illuminate\Http\Request $request): RedirectResponse
    {
        $request->validate([
            'rezgo_uid'   => 'required|string',
            'rezgo_title' => 'required|string',
        ]);

        $rezgoUid   = $request->input('rezgo_uid');
        $rezgoTitle = $request->input('rezgo_title');

        try {
            $richContent      = '';
            $shortDescription = $rezgoTitle;
            $rezgoPrice       = 0.00;
            $photoUrls        = [];

            $itemResponse = $this->api->getItemFull($rezgoUid);

            if ($itemResponse['success'] && !empty($itemResponse['data'])) {
                $itemData = $itemResponse['data'];
                $richContent = $this->api->extractDescription($itemData);
                $rezgoPrice  = $this->api->extractPrice($itemData, $rezgoUid);  // Pass UID for dynamic pricing fallback
                $photoUrls   = $this->api->extractPhotoUrls($itemData);
                \Log::info('Rezgo importAsDraft: extracted data', [
                    'uid'          => $rezgoUid,
                    'price'        => $rezgoPrice,
                    'photos_count' => count($photoUrls),
                    'photo_urls'   => $photoUrls,
                    'desc_length'  => strlen($richContent),
                    'item_keys'    => array_keys($itemData),
                ]);
            } else {
                \Log::warning('Rezgo importAsDraft: getItemFull() failed', [
                    'uid'       => $rezgoUid,
                    'error'     => $itemResponse['error'] ?? 'unknown',
                    'response'  => $itemResponse,
                ]);
            }

            // Create draft product (slug will be auto-generated by Botble system)
            $product               = new \Botble\Ecommerce\Models\Product();
            $product->name         = $rezgoTitle;
            $product->description  = $shortDescription;  // short summary for listing cards
            $product->content      = $richContent;        // full HTML body on product page
            $product->status       = 'draft';
            $product->is_variation = false;
            $product->sku          = null;
            $product->price        = $rezgoPrice;
            $product->quantity     = 1;
            $product->weight       = 0;
            $product->wide         = 0;
            $product->height       = 0;
            $product->length       = 0;
            $product->tax_id       = null;
            $product->store_id     = 1;
            $product->save();

            // Mapping with price
            RezgoProductMapping::create([
                'product_id'     => $product->id,
                'rezgo_uid'      => $rezgoUid,
                'rezgo_title'    => $rezgoTitle,
                'rezgo_price'    => $rezgoPrice,
                'passenger_type' => 'adult',
                'is_active'      => true,
            ]);

            // Download and attach images
            if (!empty($photoUrls)) {
                $this->attachRezgoImages($product, $photoUrls);
            }

            $imageNote = !empty($photoUrls) ? ', and ' . count($photoUrls) . ' image(s)' : '';
            return redirect()
                ->route('products.edit', $product->id)
                ->with('success', __(
                    'Product created as draft: ' . $rezgoTitle . $imageNote
                ));

        } catch (\Exception $e) {
            \Log::error('Rezgo importAsDraft error: ' . $e->getMessage(), [
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
            ]);
            return back()->with('error', __('Import failed: ') . $e->getMessage());
        }
    }

    private function attachRezgoImages(\Botble\Ecommerce\Models\Product $product, array $photoUrls): void
    {
        \Log::info('attachRezgoImages: starting image attachment using RvMedia::uploadFromUrl', [
            'product_id'   => $product->id,
            'photos_count' => count($photoUrls),
            'urls'         => $photoUrls,
        ]);

        $imageUrls = [];
        $isFirst   = true;

        foreach ($photoUrls as $index => $url) {
            try {
                \Log::info('Uploading image from Rezgo via RvMedia', [
                    'url'        => $url,
                    'index'      => $index,
                    'product_id' => $product->id,
                ]);

                // Use Botble's RvMedia::uploadFromUrl which handles:
                // - downloading the file
                // - storing it to the correct path
                // - generating thumbnail variants
                // - creating the MediaFile record
                // - returning the stored file URL with all variants ready
                $result = \Botble\Media\Facades\RvMedia::uploadFromUrl(
                    $url,
                    0,                    // folderId (0 = root)
                    'products',           // folderSlug - creates/uses products folder
                    'image/jpeg'          // defaultMimetype
                );

                if ($result['error'] === false && isset($result['data'])) {
                    $mediaFile = $result['data'];
                    $fileUrl = $mediaFile->url ?? null;

                    if ($fileUrl) {
                        $imageUrls[] = $fileUrl;

                        \Log::info('Image uploaded successfully via RvMedia', [
                            'url'       => $fileUrl,
                            'media_id'  => $mediaFile->id ?? null,
                            'filename'  => $mediaFile->name ?? null,
                            'mime_type' => $mediaFile->mime_type ?? null,
                        ]);

                        // Set featured image (first image only)
                        if ($isFirst) {
                            $product->image = $fileUrl;
                            $product->save();
                            \Log::info('Set featured image on product', [
                                'product_id'  => $product->id,
                                'image_field' => $fileUrl,
                            ]);
                            $isFirst = false;
                        }
                    } else {
                        \Log::warning('RvMedia upload succeeded but URL is missing', [
                            'url'    => $url,
                            'result' => $result,
                        ]);
                    }
                } else {
                    \Log::warning('RvMedia image upload failed', [
                        'url'      => $url,
                        'error'    => $result['message'] ?? 'Unknown error',
                        'product_id' => $product->id,
                    ]);
                }
            } catch (\Exception $e) {
                \Log::warning('Rezgo image attachment exception', [
                    'url'        => $url,
                    'product_id' => $product->id,
                    'error'      => $e->getMessage(),
                    'trace'      => substr($e->getTraceAsString(), 0, 500),
                ]);
            }
        }

        \Log::info('Image attachment loop complete', [
            'product_id'       => $product->id,
            'image_urls_count' => count($imageUrls),
            'image_urls'       => $imageUrls,
        ]);

        // Attach all media file URLs to product gallery
        if (!empty($imageUrls)) {
            try {
                // Get existing images from product
                $existingImages = $product->images ?? [];
                if (is_string($existingImages)) {
                    $existingImages = json_decode($existingImages, true) ?? [];
                }
                if (!is_array($existingImages)) {
                    $existingImages = [];
                }

                // Merge new image URLs with existing images
                $allImages = array_unique(array_merge($existingImages, $imageUrls));

                // Update product images attribute with JSON-encoded array of URLs
                $product->images = json_encode(array_values($allImages));
                $product->save();

                \Log::info('Images successfully attached to product gallery', [
                    'product_id'      => $product->id,
                    'new_image_urls'  => $imageUrls,
                    'existing_images' => $existingImages,
                    'all_images'      => array_values($allImages),
                    'count'           => count($allImages),
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to attach images to product gallery', [
                    'product_id' => $product->id,
                    'image_urls' => $imageUrls,
                    'error'      => $e->getMessage(),
                    'trace'      => substr($e->getTraceAsString(), 0, 500),
                ]);
            }
        } else {
            \Log::warning('No valid media files uploaded to product gallery', [
                'product_id'   => $product->id,
                'photos_count' => count($photoUrls),
            ]);
        }
    }

    public function showExternalSyncSettings(): View
    {
        $host = config('rezgo.external_sync.host', '');
        $port = config('rezgo.external_sync.port', '3306');
        $username = config('rezgo.external_sync.username', '');
        $database = config('rezgo.external_sync.database_name', '');
        $enabled = config('rezgo.external_sync.enabled', false);

        \Log::info('showExternalSyncSettings called', [
            'enabled'  => $enabled,
            'enabled_type' => gettype($enabled),
            'host'     => $host,
            'username' => $username,
            'database' => $database,
            'config_rezgo' => config('rezgo.external_sync'),
        ]);

        // Test the connection if configured
        $connectionStatus = null;
        if ($enabled && $host && $username && $database) {
            $credentials = [
                'host'     => $host,
                'port'     => $port,
                'username' => $username,
                'password' => config('rezgo.external_sync.password'),
                'database' => $database,
            ];
            $testResult = ExternalDatabaseConfigService::testConnection($credentials);
            if ($testResult['success']) {
                $connectionStatus = ExternalDatabaseConfigService::testDatabaseAccess($credentials);
            } else {
                $connectionStatus = $testResult;
            }
        }

        return view('rezgo::admin.external-sync-settings', [
            'host'     => $host,
            'port'     => $port,
            'username' => $username,
            'database' => $database,
            'enabled'  => $enabled,
            'connectionStatus' => $connectionStatus,
        ]);
    }

    public function testExternalConnection(\Illuminate\Http\Request $request)
    {
        $credentials = [
            'host'     => config('rezgo.rezgo.external_sync.host'),
            'port'     => config('rezgo.rezgo.external_sync.port', 3306),
            'username' => config('rezgo.rezgo.external_sync.username'),
            'password' => config('rezgo.rezgo.external_sync.password'),
            'database' => config('rezgo.rezgo.external_sync.database_name'),
        ];
        $result = ExternalDatabaseConfigService::testConnection($credentials);
        if ($result['success']) {
            return response()->json(ExternalDatabaseConfigService::testDatabaseAccess($credentials));
        }
        return response()->json($result);
    }

    public function createExternalTables(\Illuminate\Http\Request $request)
    {
        $credentials = [
            'host'     => config('rezgo.rezgo.external_sync.host'),
            'port'     => config('rezgo.rezgo.external_sync.port', 3306),
            'username' => config('rezgo.rezgo.external_sync.username'),
            'password' => config('rezgo.rezgo.external_sync.password'),
            'database' => config('rezgo.rezgo.external_sync.database_name'),
        ];
        return response()->json(ExternalDatabaseConfigService::createTables($credentials));
    }

    public function getExternalTableStatus(\Illuminate\Http\Request $request)
    {
        $credentials = [
            'host'     => config('rezgo.rezgo.external_sync.host'),
            'port'     => config('rezgo.rezgo.external_sync.port', 3306),
            'username' => config('rezgo.rezgo.external_sync.username'),
            'password' => config('rezgo.rezgo.external_sync.password'),
            'database' => config('rezgo.rezgo.external_sync.database_name'),
        ];
        return response()->json(ExternalDatabaseConfigService::getTableStatus($credentials));
    }

    public function saveExternalSyncSettings(\Illuminate\Http\Request $request): RedirectResponse
    {
        return back()->with('info', 'External sync is managed via .env. Set DZM_COATAA_DB_* variables and REZGO_EXTERNAL_SYNC_ENABLED=true, then run: php artisan config:cache');
    }
}
