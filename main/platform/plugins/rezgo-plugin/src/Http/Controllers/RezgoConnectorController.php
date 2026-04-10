<?php

namespace Botble\RezgoConnector\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\RezgoConnector\Http\Requests\UpdateRezgoSettingsRequest;
use Botble\RezgoConnector\Models\{RezgoSubmission, RezgoProductMapping, RezgoLog};
use Botble\RezgoConnector\Services\{RezgoSettingsService, RezgoApiService};
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RezgoConnectorController extends BaseController
{
    private RezgoSettingsService $settings;
    private RezgoApiService $api;

    public function __construct(RezgoSettingsService $settings, RezgoApiService $api)
    {
        $this->settings = $settings;
        $this->api = $api;
    }

    /**
     * Settings dashboard
     */
    public function index(): View
    {
        return view('rezgo::admin.settings', [
            'settings' => $this->settings->all(),
            'decrypted_cid' => $this->settings->getCid(),
            'decrypted_api_key' => $this->settings->getApiKey(),
            'submissionsCount' => RezgoSubmission::count(),
            'successCount' => RezgoSubmission::where('status', 'success')->count(),
            'failedCount' => RezgoSubmission::where('status', 'failed')->count(),
            'mappingsCount' => RezgoProductMapping::where('is_active', true)->count(),
            'recentLogs' => RezgoLog::latest()->limit(10)->get(),
        ]);
    }

    /**
     * Update settings
     */
    public function updateSettings(UpdateRezgoSettingsRequest $request): RedirectResponse
    {
        $this->settings->setCid($request->input('rezgo_cid'));
        $this->settings->setApiKey($request->input('rezgo_api_key'));
        $this->settings->set('default_passenger_type', $request->input('default_passenger_type', 'adult'));
        $this->settings->set('booking_date_offset', (int)$request->input('booking_date_offset', 1));
        $this->settings->set('sync_enabled', (bool)$request->input('sync_enabled', false));

        return back()->with('success', __('Settings updated successfully'));
    }

    /**
     * View submissions
     */
    public function submissions(): View
    {
        $submissions = RezgoSubmission::with('order')
            ->latest()
            ->paginate(20);

        return view('rezgo::admin.submissions', [
            'submissions' => $submissions,
        ]);
    }

    /**
     * View submission detail
     */
    public function submissionDetail(int $id): View
    {
        $submission = RezgoSubmission::with('order')->findOrFail($id);

        return view('rezgo::admin.submission-detail', [
            'submission' => $submission,
        ]);
    }

    /**
     * Show submit order form
     */
    public function showSubmitOrderForm(): View
    {
        // Fetch orders with customer and product details
        $orderIds = \DB::table('ec_orders')
            ->orderBy('id', 'desc')
            ->limit(100)
            ->pluck('id');

        $ordersData = [];
        foreach ($orderIds as $orderId) {
            $order = \DB::table('ec_orders')->where('id', $orderId)->first();
            $customer = \DB::table('ec_customers')->find($order->user_id);
            $products = \DB::table('ec_order_product')->where('order_id', $orderId)->get();
            $mappings = [];

            foreach ($products as $product) {
                $mapping = \DB::table('rezgo_product_mappings')
                    ->where('product_id', $product->product_id)
                    ->where('is_active', true)
                    ->first();

                $productInfo = \DB::table('ec_products')->where('id', $product->product_id)->first();

                $mappings[] = [
                    'product_id' => $product->product_id,
                    'product_name' => $productInfo->name ?? 'Unknown',
                    'quantity' => $product->qty ?? 1,
                    'mapped' => $mapping ? true : false,
                    'rezgo_tour' => $mapping ? $mapping->rezgo_uid : 'N/A',
                    'rezgo_title' => $mapping ? $mapping->rezgo_title ?? $mapping->rezgo_uid : 'N/A',
                ];
            }

            $ordersData[] = [
                'id' => $orderId,
                'customer_name' => $customer ? $customer->name : 'N/A',
                'total' => $order->final_price ?? $order->total ?? 0,
                'created_at' => $order->created_at,
                'products' => $mappings,
            ];
        }

        $products = \DB::table('ec_products')
            ->orderBy('name')
            ->get();

        // Fetch availability info from Rezgo
        $availabilityResponse = $this->api->searchInventory();
        $tourAvailability = [];

        if ($availabilityResponse['success'] && isset($availabilityResponse['data']['item'])) {
            $items = $availabilityResponse['data']['item'];
            if (!is_array($items) || !isset($items[0])) {
                $items = [$items];
            }
            foreach ($items as $item) {
                $uid = $item['uid'] ?? null;
                if ($uid) {
                    $tourAvailability[$uid] = [
                        'title' => $item['item'] ?? 'Unknown Tour',
                        'availability' => $item['availability'] ?? $item['avail'] ?? 0,
                        'starting' => $item['starting'] ?? 'N/A',
                    ];
                }
            }
        }

        return view('rezgo::admin.submit-order', [
            'orders' => $ordersData,
            'products' => $products,
            'tourAvailability' => $tourAvailability,
        ]);
    }

    /**
     * View product mappings
     */
    public function productMappings(): View
    {
        $mappings = RezgoProductMapping::with('product')
            ->paginate(20);

        $products = \DB::table('ec_products')
            ->orderBy('name')
            ->get();

        $rezgoTours = [];

        try {
            $inventoryResponse = $this->api->searchInventory();
            if ($inventoryResponse['success'] && isset($inventoryResponse['data']['item'])) {
                $items = $inventoryResponse['data']['item'];
                if (!is_array($items) || !isset($items[0])) {
                    $items = [$items];
                }
                $rezgoTours = $items;
            }
        } catch (\Exception $e) {
            // Fall through to hardcoded fallback
        }

        // Fallback — use known UIDs if API unavailable
        if (empty($rezgoTours)) {
            $rezgoTours = [
                ['uid'=>'418065','item'=>'Universal Orlando - 1-Day Base Ticket','name'=>'Universal Orlando - 1-Day Base Ticket'],
                ['uid'=>'418066','item'=>'Universal Orlando - 2-Day Base Ticket','name'=>'Universal Orlando - 2-Day Base Ticket'],
                ['uid'=>'418053','item'=>'Walt Disney World Resort 3 Day','name'=>'Walt Disney World Resort 3 Day'],
                ['uid'=>'418054','item'=>'Walt Disney World Resort 1 Day','name'=>'Walt Disney World Resort 1 Day'],
                ['uid'=>'418055','item'=>'Walt Disney World Resort 3 Day','name'=>'Walt Disney World Resort 3 Day'],
                ['uid'=>'418056','item'=>'Walt Disney World Resort 1 Day','name'=>'Walt Disney World Resort 1 Day'],
                ['uid'=>'418057','item'=>'Walt Disney World Resort 3 Day','name'=>'Walt Disney World Resort 3 Day'],
                ['uid'=>'418058','item'=>'Walt Disney World Resort 1 Day','name'=>'Walt Disney World Resort 1 Day'],
                ['uid'=>'418059','item'=>'Walt Disney World Resort 3 Day','name'=>'Walt Disney World Resort 3 Day'],
                ['uid'=>'418060','item'=>'Walt Disney World Resort 1 Day','name'=>'Walt Disney World Resort 1 Day'],
                ['uid'=>'418061','item'=>'Walt Disney World Resort 1 Day','name'=>'Walt Disney World Resort 1 Day'],
                ['uid'=>'418062','item'=>'Walt Disney World Resort 1 Day','name'=>'Walt Disney World Resort 1 Day'],
            ];
        }

        return view('rezgo::admin.product-mappings', [
            'mappings' => $mappings,
            'products' => $products,
            'rezgoTours' => $rezgoTours,
        ]);
    }

    /**
     * Create or update product mapping
     */
    public function saveProductMapping(\Illuminate\Http\Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|exists:ec_products,id',
            'rezgo_uid' => 'required|string',
            'rezgo_title' => 'nullable|string',
            'passenger_type' => 'required|in:adult,child,senior',
        ]);

        if ($request->filled('mapping_id')) {
            // Update existing mapping
            $mapping = RezgoProductMapping::findOrFail($request->mapping_id);
            $mapping->update([
                'product_id' => $request->product_id,
                'rezgo_uid' => $request->rezgo_uid,
                'rezgo_title' => $request->rezgo_title,
                'passenger_type' => $request->passenger_type,
                'is_active' => true,
            ]);
        } else {
            // Create or update based on product_id
            RezgoProductMapping::updateOrCreate(
                ['product_id' => $request->product_id],
                [
                    'rezgo_uid' => $request->rezgo_uid,
                    'rezgo_title' => $request->rezgo_title,
                    'passenger_type' => $request->passenger_type,
                    'is_active' => true,
                ]
            );
        }

        return back()->with('success', __('Product mapping saved successfully'));
    }

    /**
     * Delete product mapping
     */
    public function deleteProductMapping(int $id): RedirectResponse
    {
        RezgoProductMapping::findOrFail($id)->delete();

        return back()->with('success', __('Product mapping deleted'));
    }

    /**
     * View logs
     */
    public function logs(): View
    {
        $logs = RezgoLog::latest()
            ->paginate(50);

        return view('rezgo::admin.logs', [
            'logs' => $logs,
        ]);
    }

    /**
     * Test API connection
     */
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

    /**
     * Sync inventory from Rezgo
     */
    public function syncInventory(): RedirectResponse
    {
        if (!$this->settings->isConfigured()) {
            return back()->with('error', __('Rezgo API not configured'));
        }

        $response = $this->api->searchInventory();

        if (!$response['success']) {
            return back()->with('error', __('Failed to sync inventory: ' . $response['error']));
        }

        // Log the sync
        RezgoLog::sync('sync_inventory', null, 'Inventory sync completed', $response['data']);

        return back()->with('success', __('Inventory synced successfully'));
    }

    /**
     * Submit an order to Rezgo
     */
    public function submitOrder(\Illuminate\Http\Request $request): RedirectResponse
    {
        $orderId = $request->input('order_id');
        $tourDate = $request->input('tour_date');

        if (!$orderId) {
            return back()->with('error', __('Order ID required'));
        }

        if (!$tourDate) {
            return back()->with('error', __('Tour date required'));
        }

        // Validate date format and is future
        try {
            $bookingDate = Carbon::createFromFormat('Y-m-d', $tourDate);
            if ($bookingDate->isPast()) {
                return back()->with('error', __('Tour date must be in the future'));
            }
        } catch (\Exception $e) {
            return back()->with('error', __('Invalid tour date format'));
        }

        // Fetch order
        $order = \DB::table('ec_orders')->where('id', $orderId)->first();
        if (!$order) {
            return back()->with('error', __('Order not found'));
        }

        // Fetch order products
        $orderProducts = \DB::table('ec_order_product')
            ->where('order_id', $orderId)
            ->get();

        if ($orderProducts->isEmpty()) {
            return back()->with('error', __('Order has no products'));
        }

        // Fetch customer info
        $customer = \DB::table('ec_customers')->find($order->user_id);

        if (!$customer) {
            return back()->with('error', __('Customer not found'));
        }

        // Build booking data from order
        $adultsCount = 0;
        $childrenCount = 0;
        $seniorsCount = 0;
        $tourUid = null;
        $uniqueTours = [];

        foreach ($orderProducts as $product) {
            // Find mapping for this product
            $mapping = \DB::table('rezgo_product_mappings')
                ->where('product_id', $product->product_id)
                ->where('is_active', true)
                ->first();

            if (!$mapping) {
                return back()->with('error', __("Product {$product->product_id} has no Rezgo mapping"));
            }

            // Use first tour UID found
            if (!$tourUid) {
                $tourUid = $mapping->rezgo_uid;
            }

            $uniqueTours[] = $mapping->rezgo_uid;

            // Count passengers by type
            $qty = (int)($product->qty ?? 1);
            match ($mapping->passenger_type) {
                'adult' => $adultsCount += $qty,
                'child' => $childrenCount += $qty,
                'senior' => $seniorsCount += $qty,
                default => $adultsCount += $qty,
            };
        }

        // Validate passenger counts
        if ($adultsCount < 1) {
            return back()->with('error', __('At least one adult passenger is required'));
        }

        // Prepare booking data with selected tour date
        $bookingData = [
            'order_id' => $orderId,
            'book' => $tourUid,
            'date' => $tourDate,
            'adult_num' => $adultsCount,
            'child_num' => $childrenCount,
            'senior_num' => $seniorsCount,
            'tour_first_name' => $customer->name ?? 'Customer',
            'tour_last_name' => 'Order-' . $orderId,
            'tour_email_address' => $customer->email ?? 'noemail@test.com',
            'tour_phone_number' => $customer->phone ?? '555-0000',
            'tour_address_1' => $customer->address ?? '123 Main St',
            'tour_city' => $customer->city ?? 'Orlando',
            'tour_stateprov' => $customer->province ?? 'FL',
            'tour_country' => $customer->country ?? 'US',
            'tour_postal_code' => $customer->zip_code ?? '12345',
            'payment_method' => 'Credit Cards',
        ];

        // Submit to Rezgo
        $response = $this->api->commitBooking($bookingData);

        if ($response['success']) {
            $transNum = $response['trans_num'] ?? null;

            // Save submission record
            RezgoSubmission::updateOrCreate(
                ['order_id' => $orderId],
                [
                    'status' => 'success',
                    'rezgo_booking_id' => $transNum,
                    'request_payload' => json_encode($bookingData),
                    'response_payload' => json_encode($response['data'] ?? []),
                    'http_status' => 201,
                ]
            );

            $message = __("Order submitted to Rezgo successfully! Transaction: {$transNum}");
            return back()->with('success', $message);
        } else {
            // Save failed submission
            $errorMessage = $response['error'] ?? 'Unknown error';
            $errorCode = $response['error_code'] ?? '';
            $fullError = $errorMessage . ($errorCode ? " [$errorCode]" : '');

            RezgoSubmission::updateOrCreate(
                ['order_id' => $orderId],
                [
                    'status' => 'failed',
                    'request_payload' => json_encode($bookingData),
                    'response_payload' => json_encode($response),
                    'http_status' => $response['status'] ?? 500,
                    'error_message' => $fullError,
                ]
            );

            return back()->with('error', __('Submission failed: ' . $fullError));
        }
    }

    /**
     * Import Rezgo inventory as draft product
     */
    public function importAsDraft(\Illuminate\Http\Request $request): RedirectResponse
    {
        $rezgoUid = $request->query('rezgo_uid');
        $rezgoTitle = $request->query('rezgo_title');

        if (!$rezgoUid || !$rezgoTitle) {
            return back()->with('error', __('Missing Rezgo inventory information'));
        }

        try {
            // Check if product already exists with this title
            $existingProduct = \Botble\Ecommerce\Models\Product::where('name', $rezgoTitle)->first();
            if ($existingProduct) {
                // Create mapping for existing product
                RezgoProductMapping::updateOrCreate(
                    ['product_id' => $existingProduct->id],
                    [
                        'rezgo_uid' => $rezgoUid,
                        'rezgo_title' => $rezgoTitle,
                        'passenger_type' => 'adult',
                        'is_active' => true,
                    ]
                );
                return back()->with('success', __('Mapped to existing product: :name', ['name' => $rezgoTitle]));
            }

            // Create new draft product with correct fields
            $product = new \Botble\Ecommerce\Models\Product();
            $product->name = $rezgoTitle;
            $product->description = __('Auto-imported from Rezgo inventory UID: :uid', ['uid' => $rezgoUid]);
            $product->content = __('Booking details will be added after product activation.');
            $product->status = 'draft';
            $product->is_variation = false;
            $product->sku = 'REZGO-' . $rezgoUid;
            $product->price = 0;
            $product->quantity = 1;
            $product->weight = 0;
            $product->wide = 0;  // Note: uses 'wide' not 'width'
            $product->height = 0;
            $product->length = 0;
            $product->tax_id = null;
            $product->store_id = 1;
            
            $product->save();

            // Create mapping
            RezgoProductMapping::create([
                'product_id' => $product->id,
                'rezgo_uid' => $rezgoUid,
                'rezgo_title' => $rezgoTitle,
                'passenger_type' => 'adult',
                'is_active' => true,
            ]);

            return back()->with('success', __('✅ Successfully created draft product: :name. Check the Products section to publish.', 
                ['name' => $rezgoTitle]));
        } catch (\Exception $e) {
            \Log::error('Rezgo import-as-draft error: ' . $e->getMessage() . ' [' . $e->getFile() . ':' . $e->getLine() . '] Trace: ' . $e->getTraceAsString());
            return back()->with('error', __('❌ Import failed: ') . $e->getMessage());
        }
    }
}

