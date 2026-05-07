# Rezgo Connector — Complete Fix & Feature Implementation

> **For the executing agent:**
> Work through each fix in order. Every section states the exact file path, what to do,
> and provides the complete replacement content. Do not modify anything not listed here.
> Do not rename classes, namespaces, or migration files.
> After all files are replaced, run the post-deploy checklist at the bottom.

---

## FIX 1 — CRITICAL: Duplicate listener file check

**Action:** Run this command on the server to confirm there is only one copy:

```bash
find platform/plugins/rezgo-plugin/src -name "SubmitOrderToRezgo.php"
```

If more than one path is returned, delete every copy except `src/Listeners/SubmitOrderToRezgo.php`.

Then replace `src/Listeners/SubmitOrderToRezgo.php` with the following:

```php
<?php

namespace Botble\RezgoConnector\Listeners;

use Botble\Ecommerce\Events\OrderPlacedEvent;
use Botble\RezgoConnector\Models\{RezgoProductMapping, RezgoSubmission, RezgoLog};
use Botble\RezgoConnector\Services\{RezgoApiService, RezgoSettingsService};
use Illuminate\Support\Facades\Log;

class SubmitOrderToRezgo
{
    private RezgoSettingsService $settings;
    private RezgoApiService $api;

    public function __construct(RezgoSettingsService $settings, RezgoApiService $api)
    {
        $this->settings = $settings;
        $this->api      = $api;
    }

    public function handle(OrderPlacedEvent $event): void
    {
        $order = $event->order;

        if (!$this->settings->isSyncEnabled()) {
            RezgoLog::info('submit_order', $order->id, 'Sync disabled, skipping order');
            return;
        }

        try {
            RezgoLog::sync('submit_order', $order->id, 'Processing order for Rezgo');
            $this->submitOrderToRezgo($order);
        } catch (\Exception $e) {
            RezgoLog::error('submit_order', $order->id, 'Exception: ' . $e->getMessage());
            Log::channel('rezgo')->error('OrderPlacedEvent failed', [
                'order_id' => $order->id,
                'error'    => $e->getMessage(),
                'trace'    => $e->getTraceAsString(),
            ]);
        }
    }

    private function submitOrderToRezgo($order): void
    {
        // FIX: loop ALL items, not just first — collect all passenger counts
        $firstItem     = null;
        $rezgoUid      = null;
        $adultsCount   = 0;
        $childrenCount = 0;
        $seniorsCount  = 0;

        if ($order->items && $order->items->count() > 0) {
            foreach ($order->items as $item) {
                if ($firstItem === null) {
                    $firstItem = $item;
                }

                $mapping = RezgoProductMapping::getByProductId($item->product_id);

                if (!$mapping || !$mapping->rezgo_uid) {
                    RezgoLog::warning('submit_order', $order->id, 'No Rezgo mapping for product', [
                        'product_id' => $item->product_id,
                    ]);
                    continue;
                }

                if ($rezgoUid === null) {
                    $rezgoUid = $mapping->rezgo_uid;
                }

                $qty = (int)($item->qty ?? 1);
                match ($mapping->passenger_type) {
                    'child'  => $childrenCount += $qty,
                    'senior' => $seniorsCount  += $qty,
                    default  => $adultsCount   += $qty,
                };
            }
        }

        // FIX: $firstItem may be null — safe reference below
        if (empty($rezgoUid)) {
            RezgoLog::warning(
                'submit_order',
                $order->id,
                'Skipping — no tour UID mapped for product ' . ($firstItem->product_id ?? 'unknown')
            );
            return;
        }

        if ($adultsCount < 1 && $childrenCount < 1 && $seniorsCount < 1) {
            $adultsCount = 1;
        }

        $address  = $order->address;
        $customer = $order->user;

        $firstName   = $customer?->first_name ?? ($address?->first_name ?? 'Guest');
        $lastName    = $customer?->last_name  ?? ($address?->last_name  ?? 'Customer');
        $email       = $customer?->email      ?? ($address?->email      ?? 'noemail@farmart.test');
        $phone       = $address?->phone       ?? '000-000-0000';
        $addressLine = $address?->address     ?? '';
        $city        = $address?->city        ?? 'Unknown';
        $state       = $address?->state       ?? '';
        $country     = $address?->country     ?? 'US';
        $zipCode     = $address?->zip_code    ?? '';

        $bookingDateOffset = $this->settings->getBookingDateOffset();
        $bookingDate       = date('Y-m-d', strtotime("+{$bookingDateOffset} days"));

        $bookingData = [
            'book'               => $rezgoUid,
            'date'               => $bookingDate,
            'agree_terms'        => '1',
            'payment_method'     => 'Cash',
            'tour_first_name'    => $firstName,
            'tour_last_name'     => $lastName,
            'tour_address_1'     => $addressLine,
            'tour_city'          => $city,
            'tour_stateprov'     => $state,
            'tour_country'       => $country,
            'tour_postal_code'   => $zipCode,
            'tour_phone_number'  => $phone,
            'tour_email_address' => $email,
            'order_id'           => (string)$order->id,
            'adult_num'          => $adultsCount,
            'child_num'          => $childrenCount,
            'senior_num'         => $seniorsCount,
        ];

        $response = $this->api->commitBooking($bookingData);

        $safeBookingData = $bookingData;
        unset(
            $safeBookingData['tour_email_address'],
            $safeBookingData['tour_phone_number'],
            $safeBookingData['tour_address_1'],
            $safeBookingData['tour_postal_code']
        );

        RezgoSubmission::create([
            'order_id'         => $order->id,
            'rezgo_booking_id' => $response['trans_num'] ?? null,
            'status'           => $response['success'] ? 'success' : 'failed',
            'request_payload'  => json_encode($safeBookingData, JSON_PRETTY_PRINT),
            'response_payload' => json_encode($response['data'] ?? $response, JSON_PRETTY_PRINT),
            'http_status'      => $response['status'] ?? 0,
            'error_message'    => !$response['success'] ? $response['error'] : null,
        ]);

        if ($response['success']) {
            RezgoLog::sync('submit_order', $order->id, 'Order submitted successfully', [
                'trans_num' => $response['trans_num'],
            ]);
            // FIX: removed $order->update(['meta'=>...]) — ec_orders has no meta column
        } else {
            RezgoLog::error('submit_order', $order->id, 'Order submission failed: ' . $response['error']);
        }
    }
}
```

---

## FIX 2 — CRITICAL: isSuccessful() checks wrong HTTP status

**File:** `src/Models/RezgoSubmission.php`

Replace the entire file:

```php
<?php

namespace Botble\RezgoConnector\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RezgoSubmission extends Model
{
    protected $table = 'rezgo_submissions';

    protected $fillable = [
        'order_id',
        'rezgo_booking_id',
        'status',
        'request_payload',
        'response_payload',
        'http_status',
        'error_message',
    ];

    protected $casts = [
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'http_status' => 'integer',
    ];

    public $timestamps = true;

    public function order(): BelongsTo
    {
        return $this->belongsTo(
            \Botble\Ecommerce\Models\Order::class,
            'order_id',
            'id'
        );
    }

    // FIX: was checking http_status === 200 but controller saves 201 on success.
    // The status string column is authoritative.
    public function isSuccessful(): bool
    {
        return $this->status === 'success';
    }

    public function getRequestData(): array
    {
        return json_decode($this->request_payload, true) ?? [];
    }

    public function getResponseData(): array
    {
        return json_decode($this->response_payload, true) ?? [];
    }
}
```

---

## FIX 3 — HIGH + FEATURE: RezgoApiService — full rewrite

**Root causes fixed here:**
- `getItemDetails()` was sending `<instruction>search</instruction>` which only returns summary data.
  Full description, photos, and price_list require `<instruction>item</instruction>`.
- `xmlToArray()` discarded child elements when a node had any text content (CDATA bug).
- `LIBXML_NOCDATA` flag was missing from `simplexml_load_string` so CDATA was not expanded.
- New public helpers `getItemFull()`, `extractDescription()`, `extractPrice()`, `extractPhotoUrls()`
  added so the controller can call them cleanly.

**File:** `src/Services/RezgoApiService.php`

Replace the entire file:

```php
<?php

namespace Botble\RezgoConnector\Services;

use Illuminate\Support\Facades\Http;
use Botble\RezgoConnector\Models\RezgoLog;

class RezgoApiService
{
    private RezgoSettingsService $settings;
    private string $baseUrl = 'https://api.rezgo.com/xml';

    public function __construct(RezgoSettingsService $settings)
    {
        $this->settings = $settings;
    }

    // =========================================================================
    // BOOKING
    // =========================================================================

    public function commitBooking(array $bookingData): array
    {
        if (!$this->settings->isConfigured()) {
            $error = 'Rezgo API not configured. Please add CID and API Key in settings.';
            RezgoLog::error('commit_booking', null, $error);
            return ['success' => false, 'error' => $error, 'status' => 0];
        }

        try {
            $orderId    = $bookingData['order_id'] ?? null;
            $xmlPayload = $this->buildCommitXmlPayload($bookingData);

            $logData = $bookingData;
            unset($logData['key']);
            RezgoLog::sync('commit_booking', $orderId, 'Submitting booking via POST XML', $logData);

            $response     = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/xml'])
                ->withBody($xmlPayload, 'application/xml')
                ->post($this->baseUrl);

            $responseBody = $response->body();
            RezgoLog::sync('commit_booking', $orderId, 'Raw Rezgo response: ' . $responseBody);

            $responseData = $this->parseXmlResponse($responseBody);

            if (!is_array($responseData)) {
                $responseData = ['content' => $responseData];
            }

            $isSuccess = isset($responseData['status']) && $responseData['status'] == 1;

            if ($isSuccess) {
                $transNum = $responseData['trans_num'] ?? $responseData['booking_id'] ?? null;
                RezgoLog::sync('commit_booking', $orderId, 'Booking successful #' . $transNum);
                return [
                    'success'   => true,
                    'status'    => 200,
                    'data'      => $responseData,
                    'trans_num' => $transNum,
                    'message'   => 'Booking complete',
                ];
            }

            $error     = $responseData['e'] ?? $responseData['message'] ?? 'No success status from Rezgo';
            $errorCode = $responseData['error_code'] ?? 'N/A';
            RezgoLog::error('commit_booking', $orderId, "Booking failed [$errorCode]: $error", $responseData);
            return [
                'success'    => false,
                'status'     => $response->status(),
                'error'      => $error,
                'error_code' => $errorCode,
                'data'       => $responseData,
            ];

        } catch (\Exception $e) {
            RezgoLog::error('commit_booking', $bookingData['order_id'] ?? null, 'API request failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage(), 'status' => 0];
        }
    }

    // =========================================================================
    // INVENTORY SEARCH (summary only — use getItemFull for description/photos)
    // =========================================================================

    public function searchInventory(array $filters = []): array
    {
        if (!$this->settings->isConfigured()) {
            return ['success' => false, 'error' => 'API not configured'];
        }

        try {
            $cid    = $this->settings->getCid();
            $apiKey = $this->settings->getApiKey();

            $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml .= '<request>' . PHP_EOL;
            $xml .= '  <transcode>' . htmlspecialchars($cid)    . '</transcode>' . PHP_EOL;
            $xml .= '  <key>'       . htmlspecialchars($apiKey) . '</key>'       . PHP_EOL;
            $xml .= '  <instruction>search</instruction>'                        . PHP_EOL;
            if (isset($filters['filter_type'])) {
                $xml .= '  <filter_type>' . htmlspecialchars($filters['filter_type']) . '</filter_type>' . PHP_EOL;
            }
            $xml .= '</request>' . PHP_EOL;

            $response     = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/xml'])
                ->withBody($xml, 'application/xml')
                ->post($this->baseUrl);

            $responseData = $this->parseXmlResponse($response->body());
            return ['success' => !isset($responseData['error']), 'data' => $responseData];

        } catch (\Exception $e) {
            RezgoLog::error('search_inventory', null, 'Search failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    // =========================================================================
    // COMPANY INFO
    // =========================================================================

    public function getCompanyInfo(): array
    {
        if (!$this->settings->isConfigured()) {
            return ['success' => false, 'error' => 'API not configured'];
        }

        try {
            $cid    = $this->settings->getCid();
            $apiKey = $this->settings->getApiKey();

            $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml .= '<request>' . PHP_EOL;
            $xml .= '  <transcode>' . htmlspecialchars($cid)    . '</transcode>' . PHP_EOL;
            $xml .= '  <key>'       . htmlspecialchars($apiKey) . '</key>'       . PHP_EOL;
            $xml .= '  <instruction>company</instruction>'                       . PHP_EOL;
            $xml .= '</request>' . PHP_EOL;

            $response     = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/xml'])
                ->withBody($xml, 'application/xml')
                ->post($this->baseUrl);

            $responseData = $this->parseXmlResponse($response->body());
            return ['success' => !isset($responseData['error']), 'data' => $responseData];

        } catch (\Exception $e) {
            RezgoLog::error('get_company', null, 'Failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    // =========================================================================
    // FULL ITEM DETAIL (instruction=item — returns description, photos, price_list)
    // =========================================================================

    /**
     * FIX: previous getItemDetails() used instruction=search which only returns summary.
     * instruction=item returns the full record including:
     *   <desc>       — full HTML description paragraph (CDATA)
     *   <photos>     — nested photo nodes with image filenames
     *   <price_list> — per-type pricing (adult, child, senior)
     *   <option>, <duration>, <inclusions>, <exclusions>, <highlights>, <notes>
     */
    public function getItemFull(string $uid): array
    {
        if (!$this->settings->isConfigured()) {
            return ['success' => false, 'error' => 'API not configured'];
        }

        try {
            $cid    = $this->settings->getCid();
            $apiKey = $this->settings->getApiKey();

            $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml .= '<request>' . PHP_EOL;
            $xml .= '  <transcode>' . htmlspecialchars($cid)    . '</transcode>' . PHP_EOL;
            $xml .= '  <key>'       . htmlspecialchars($apiKey) . '</key>'       . PHP_EOL;
            $xml .= '  <instruction>item</instruction>'                          . PHP_EOL;
            $xml .= '  <uid>'       . htmlspecialchars($uid)    . '</uid>'       . PHP_EOL;
            $xml .= '</request>' . PHP_EOL;

            \Log::info('Rezgo getItemFull request', ['uid' => $uid]);

            $response = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/xml'])
                ->withBody($xml, 'application/xml')
                ->post($this->baseUrl);

            $rawBody = $response->body();
            \Log::info('Rezgo getItemFull raw response', [
                'uid'     => $uid,
                'preview' => substr($rawBody, 0, 2000),
            ]);

            $responseData = $this->parseXmlResponse($rawBody);

            if (isset($responseData['item'])) {
                $item = $responseData['item'];
                if (is_array($item) && isset($item[0]) && is_array($item[0])) {
                    $item = $item[0];
                }
                return ['success' => true, 'data' => $item];
            }

            // Fallback: response root may already be the item
            if (isset($responseData['uid']) || isset($responseData['name'])) {
                return ['success' => true, 'data' => $responseData];
            }

            RezgoLog::error('get_item_full', null, 'Item not found in response for uid: ' . $uid);
            return ['success' => false, 'error' => 'Item not found', 'data' => $responseData];

        } catch (\Exception $e) {
            RezgoLog::error('get_item_full', null, 'Failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    // Legacy alias — kept for any other callers
    public function getItemDetails(string $uid): array
    {
        return $this->getItemFull($uid);
    }

    // =========================================================================
    // EXTRACTION HELPERS (used by controller and sync command)
    // =========================================================================

    /**
     * Extract the full HTML description from item data.
     * Primary field in Rezgo item response is <desc> (CDATA).
     */
    public function extractDescription(array $itemData): string
    {
        $fields = ['desc', 'details', 'description', 'overview', 'highlights', 'inclusions', 'notes', 'content'];

        foreach ($fields as $field) {
            if (!empty($itemData[$field])) {
                $val = is_array($itemData[$field])
                    ? ($itemData[$field][0] ?? '')
                    : $itemData[$field];
                $val = (string)$val;
                if (!empty(trim(strip_tags($val)))) {
                    return $val;
                }
            }
        }

        return '';
    }

    /**
     * Extract the best available price from item data.
     * Checks direct price fields first, then price_list structure.
     */
    public function extractPrice(array $itemData): float
    {
        $directFields = ['price', 'rate', 'rate_period', 'adult_price', 'cost'];
        foreach ($directFields as $field) {
            if (!empty($itemData[$field])) {
                $val   = is_array($itemData[$field]) ? ($itemData[$field][0] ?? 0) : $itemData[$field];
                $price = (float)preg_replace('/[^0-9.]/', '', (string)$val);
                if ($price > 0) {
                    return $price;
                }
            }
        }

        // price_list: <price_list><price><type>Adult</type><amount>99.00</amount></price></price_list>
        if (!empty($itemData['price_list'])) {
            $prices = $itemData['price_list']['price'] ?? [];
            if (!empty($prices)) {
                if (isset($prices['type'])) {
                    $prices = [$prices];
                }
                // Prefer adult price
                foreach ($prices as $entry) {
                    if (is_array($entry)) {
                        $type   = strtolower($entry['type'] ?? '');
                        $amount = (float)($entry['amount'] ?? $entry['cost'] ?? 0);
                        if (str_contains($type, 'adult') && $amount > 0) {
                            return $amount;
                        }
                    }
                }
                // Fallback: first non-zero price
                foreach ($prices as $entry) {
                    if (is_array($entry)) {
                        $amount = (float)($entry['amount'] ?? $entry['cost'] ?? 0);
                        if ($amount > 0) {
                            return $amount;
                        }
                    }
                }
            }
        }

        return 0.00;
    }

    /**
     * Extract all per-type prices as an array (used by dynamic pricing sync).
     * Returns: ['adult' => 99.00, 'child' => 79.00, 'senior' => 89.00]
     */
    public function extractAllPrices(array $itemData): array
    {
        $result = ['adult' => 0.00, 'child' => 0.00, 'senior' => 0.00];

        if (!empty($itemData['price_list'])) {
            $prices = $itemData['price_list']['price'] ?? [];
            if (!empty($prices)) {
                if (isset($prices['type'])) {
                    $prices = [$prices];
                }
                foreach ($prices as $entry) {
                    if (!is_array($entry)) {
                        continue;
                    }
                    $type   = strtolower($entry['type'] ?? '');
                    $amount = (float)($entry['amount'] ?? $entry['cost'] ?? 0);
                    if (str_contains($type, 'adult'))  $result['adult']  = $amount;
                    if (str_contains($type, 'child'))  $result['child']  = $amount;
                    if (str_contains($type, 'senior')) $result['senior'] = $amount;
                }
            }
        }

        // Fill any missing type from direct field if zero
        if ($result['adult'] === 0.00) {
            $result['adult'] = $this->extractPrice($itemData);
        }

        return $result;
    }

    /**
     * Extract photo URLs from item data.
     * Handles three Rezgo photo structures and returns up to 5 absolute URLs.
     */
    public function extractPhotoUrls(array $itemData): array
    {
        $cid  = $this->settings->getCid();
        $urls = [];

        // Single flat field
        if (!empty($itemData['photo_file_name'])) {
            $fn = is_array($itemData['photo_file_name'])
                ? ($itemData['photo_file_name'][0] ?? '')
                : $itemData['photo_file_name'];
            if (!empty($fn)) {
                $urls[] = $this->buildPhotoUrl((string)$fn, $cid);
            }
        }

        // Nested <photos> block
        if (!empty($itemData['photos'])) {
            $photos    = $itemData['photos'];
            $photoList = $photos['photo'] ?? $photos;

            if (is_string($photoList)) {
                $photoList = [$photoList];
            } elseif (is_array($photoList) && !isset($photoList[0])) {
                $photoList = [$photoList];
            }

            foreach ($photoList as $photo) {
                if (count($urls) >= 5) break;

                if (is_string($photo)) {
                    $urls[] = filter_var($photo, FILTER_VALIDATE_URL)
                        ? $photo
                        : $this->buildPhotoUrl($photo, $cid);
                } elseif (is_array($photo)) {
                    $fn = $photo['file_name'] ?? $photo['filename'] ?? $photo['url'] ?? '';
                    if (!empty($fn)) {
                        $urls[] = filter_var($fn, FILTER_VALIDATE_URL)
                            ? $fn
                            : $this->buildPhotoUrl((string)$fn, $cid);
                    }
                }
            }
        }

        return array_slice(array_unique($urls), 0, 5);
    }

    // =========================================================================
    // PRIVATE HELPERS
    // =========================================================================

    private function buildPhotoUrl(string $filename, string $cid): string
    {
        if (filter_var($filename, FILTER_VALIDATE_URL)) {
            return $filename;
        }
        return 'https://cdn.rezgo.com/photos/' . $cid . '/' . ltrim($filename, '/');
    }

    private function buildCommitXmlPayload(array $bookingData): string
    {
        $cid    = $this->settings->getCid();
        $apiKey = $this->settings->getApiKey();

        $uid         = htmlspecialchars($bookingData['book']               ?? '');
        $date        = htmlspecialchars($bookingData['date']               ?? date('Y-m-d', strtotime('+1 day')));
        $numAdults   = (int)($bookingData['adult_num']                     ?? 1);
        $numChildren = (int)($bookingData['child_num']                     ?? 0);
        $numSeniors  = (int)($bookingData['senior_num']                    ?? 0);

        $firstName = htmlspecialchars($bookingData['tour_first_name']    ?? 'Dreamzone');
        $lastName  = htmlspecialchars($bookingData['tour_last_name']     ?? 'Test');
        $email     = htmlspecialchars($bookingData['tour_email_address'] ?? 'test@dreamzone.com');
        $phone     = htmlspecialchars($bookingData['tour_phone_number']  ?? '4075550123');
        $address   = htmlspecialchars($bookingData['tour_address_1']     ?? '123 Main St');
        $city      = htmlspecialchars($bookingData['tour_city']          ?? 'Orlando');
        $state     = htmlspecialchars($bookingData['tour_stateprov']     ?? 'FL');
        $postal    = htmlspecialchars($bookingData['tour_postal_code']   ?? '32801');
        $country   = htmlspecialchars($bookingData['tour_country']       ?? 'US');

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<request>' . PHP_EOL;
        $xml .= '  <transcode>' . htmlspecialchars($cid) . '</transcode>' . PHP_EOL;
        $xml .= '  <key>'       . htmlspecialchars($apiKey) . '</key>'   . PHP_EOL;
        $xml .= '  <instruction>commit</instruction>'                     . PHP_EOL;
        $xml .= '  <booking>' . PHP_EOL;
        $xml .= '    <book>' . $uid  . '</book>' . PHP_EOL;
        $xml .= '    <date>' . $date . '</date>' . PHP_EOL;
        if ($numAdults > 0)   $xml .= '    <adult_num>'  . $numAdults   . '</adult_num>'  . PHP_EOL;
        if ($numChildren > 0) $xml .= '    <child_num>'  . $numChildren . '</child_num>'  . PHP_EOL;
        if ($numSeniors > 0)  $xml .= '    <senior_num>' . $numSeniors  . '</senior_num>' . PHP_EOL;
        $xml .= '  </booking>' . PHP_EOL;
        $xml .= '  <payment>' . PHP_EOL;
        $xml .= '    <tour_first_name>'    . $firstName . '</tour_first_name>'    . PHP_EOL;
        $xml .= '    <tour_last_name>'     . $lastName  . '</tour_last_name>'     . PHP_EOL;
        $xml .= '    <tour_email_address>' . $email     . '</tour_email_address>' . PHP_EOL;
        $xml .= '    <tour_phone_number>'  . $phone     . '</tour_phone_number>'  . PHP_EOL;
        $xml .= '    <tour_address_1>'     . $address   . '</tour_address_1>'     . PHP_EOL;
        $xml .= '    <tour_city>'          . $city      . '</tour_city>'          . PHP_EOL;
        $xml .= '    <tour_stateprov>'     . $state     . '</tour_stateprov>'     . PHP_EOL;
        $xml .= '    <tour_postal_code>'   . $postal    . '</tour_postal_code>'   . PHP_EOL;
        $xml .= '    <tour_country>'       . $country   . '</tour_country>'       . PHP_EOL;
        $xml .= '    <payment_method>Cash</payment_method>' . PHP_EOL;
        $xml .= '    <agree_terms>1</agree_terms>'          . PHP_EOL;
        $xml .= '  </payment>' . PHP_EOL;
        $xml .= '</request>' . PHP_EOL;
        return $xml;
    }

    /**
     * FIX: Added LIBXML_NOCDATA so CDATA sections expand to plain text automatically.
     */
    private function parseXmlResponse(string $xmlBody): array|string
    {
        try {
            $xml = simplexml_load_string($xmlBody, 'SimpleXMLElement', LIBXML_NOCDATA);
            if ($xml === false) {
                return ['error' => 'Invalid XML response'];
            }
            return $this->xmlToArray($xml);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * FIX: Previous version used trim((string)$child) ?: $this->xmlToArray($child)
     * which discarded child elements whenever a node had any text content.
     * Now: recurse into children if they exist; only read text for true leaf nodes.
     */
    private function xmlToArray($xml): array|string
    {
        if (is_string($xml)) {
            return $xml;
        }

        $array    = [];
        $children = $xml->children();

        if (iterator_count($children) > 0) {
            foreach ($children as $name => $child) {
                $value = $this->xmlToArray($child);
                if (isset($array[$name])) {
                    if (!is_array($array[$name]) || !isset($array[$name][0])) {
                        $array[$name] = [$array[$name]];
                    }
                    $array[$name][] = $value;
                } else {
                    $array[$name] = $value;
                }
            }
        } else {
            $text = (string)$xml;
            if ($text !== '') {
                if (!$xml->attributes() || iterator_count($xml->attributes()) === 0) {
                    return $text;
                }
                $array['_value'] = $text;
            }
        }

        if ($xml->attributes()) {
            foreach ($xml->attributes() as $name => $value) {
                $array['@' . $name] = (string)$value;
            }
        }

        return $array ?: '';
    }
}
```

---

## FIX 4 — HIGH + FEATURE: Controller — importAsDraft, productMappings, env() fixes

**File:** `src/Http/Controllers/RezgoConnectorController.php`

Replace the entire file:

```php
<?php

namespace Botble\RezgoConnector\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\RezgoConnector\Http\Requests\UpdateRezgoSettingsRequest;
use Botble\RezgoConnector\Models\{RezgoSubmission, RezgoProductMapping, RezgoLog};
use Botble\RezgoConnector\Services\{RezgoSettingsService, RezgoApiService, ExternalDatabaseSyncService, ExternalDatabaseConfigService};
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
            $mappings = [];

            foreach ($products as $product) {
                $mapping     = \DB::table('rezgo_product_mappings')
                    ->where('product_id', $product->product_id)
                    ->where('is_active', true)
                    ->first();
                $productInfo = \DB::table('ec_products')->where('id', $product->product_id)->first();

                $mappings[] = [
                    'product_id'   => $product->product_id,
                    'product_name' => $productInfo->name ?? 'Unknown',
                    'quantity'     => $product->qty ?? 1,
                    'mapped'       => (bool)$mapping,
                    'rezgo_tour'   => $mapping ? $mapping->rezgo_uid : 'N/A',
                    'rezgo_title'  => $mapping ? ($mapping->rezgo_title ?? $mapping->rezgo_uid) : 'N/A',
                ];
            }

            $ordersData[] = [
                'id'            => $orderId,
                'customer_name' => $customer ? $customer->name : 'N/A',
                'total'         => $order->final_price ?? $order->total ?? 0,
                'created_at'    => $order->created_at,
                'products'      => $mappings,
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
                        'title'        => $item['item'] ?? $item['name'] ?? 'Unknown Tour',
                        'availability' => $item['availability'] ?? $item['avail'] ?? 0,
                        'starting'     => $item['starting'] ?? 'N/A',
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
        $retzgoPaginator     = null;
        $inventoryError      = null;

        try {
            $inventoryResponse = $this->api->searchInventory();

            if ($inventoryResponse['success'] && isset($inventoryResponse['data']['item'])) {
                $items = $inventoryResponse['data']['item'];

                if (!is_array($items) || !isset($items[0])) {
                    $items = [$items];
                }

                // Normalise display name across Rezgo field name variations
                $items = array_map(function ($item) {
                    $item['display_name'] = $item['item'] ?? $item['name'] ?? $item['uid'] ?? 'Unknown';
                    return $item;
                }, $items);

                $totalInventoryCount = count($items);

                $page    = (int)request()->query('rezgo_page', 1);
                $perPage = 50;
                $offset  = ($page - 1) * $perPage;
                $slice   = array_slice($items, $offset, $perPage);

                // FIX: paginator was built but never passed to view before
                $retzgoPaginator = new \Illuminate\Pagination\Paginator(
                    $slice,
                    $perPage,
                    $page,
                    [
                        'path'     => route('rezgo.product-mappings.index'),
                        'query'    => request()->query(),
                        'fragment' => 'rezgo-inventory',
                    ]
                );
                $retzgoPaginator->setPageName('rezgo_page');
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
            'retzgoPaginator'     => $retzgoPaginator,
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
            match ($mapping->passenger_type) {
                'child'  => $childrenCount += $qty,
                'senior' => $seniorsCount  += $qty,
                default  => $adultsCount   += $qty,
            };
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
                    'request_payload'  => json_encode($bookingData),
                    'response_payload' => json_encode($response['data'] ?? []),
                    'http_status'      => $response['status'] ?? 200,
                ]
            );
            return back()->with('success', __("Order submitted to Rezgo successfully! Transaction: {$transNum}"));
        }

        $fullError = ($response['error'] ?? 'Unknown error') . ($response['error_code'] ? ' [' . $response['error_code'] . ']' : '');
        RezgoSubmission::updateOrCreate(
            ['order_id' => $orderId],
            [
                'status'           => 'failed',
                'request_payload'  => json_encode($bookingData),
                'response_payload' => json_encode($response),
                'http_status'      => $response['status'] ?? 500,
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

                \Log::info('Rezgo importAsDraft fields', [
                    'uid'    => $rezgoUid,
                    'fields' => array_keys($itemData),
                ]);

                $richContent = $this->api->extractDescription($itemData);
                $rezgoPrice  = $this->api->extractPrice($itemData);
                $photoUrls   = $this->api->extractPhotoUrls($itemData);

                $shortParts = [];
                if (!empty($itemData['option'])) {
                    $opt = is_array($itemData['option']) ? ($itemData['option'][0] ?? '') : $itemData['option'];
                    if (!empty(trim((string)$opt))) $shortParts[] = trim((string)$opt);
                }
                if (!empty($itemData['duration'])) {
                    $dur = is_array($itemData['duration']) ? ($itemData['duration'][0] ?? '') : $itemData['duration'];
                    if (!empty(trim((string)$dur))) $shortParts[] = 'Duration: ' . trim((string)$dur);
                }
                if (!empty($shortParts)) {
                    $shortDescription = implode(' — ', $shortParts);
                }

                \Log::info('Rezgo importAsDraft extracted', [
                    'price'       => $rezgoPrice,
                    'desc_length' => strlen($richContent),
                    'photos'      => count($photoUrls),
                    'photo_urls'  => $photoUrls,
                ]);
            } else {
                \Log::warning('Rezgo importAsDraft: getItemFull() failed', [
                    'uid'   => $rezgoUid,
                    'error' => $itemResponse['error'] ?? 'unknown',
                ]);
            }

            // Unique slug
            $baseSlug = \Illuminate\Support\Str::slug($rezgoTitle);
            $slug     = $baseSlug;
            $counter  = 1;
            while (\DB::table('ec_products')->where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }

            // Create draft product
            $product               = new \Botble\Ecommerce\Models\Product();
            $product->name         = $rezgoTitle;
            $product->slug         = $slug;
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
                    'Draft product created. Description, price' . $imageNote .
                    ' imported from Rezgo. Review and publish when ready.'
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
        $storageDir  = 'products/' . date('Y/m');
        $storageDisk = \Storage::disk('public');

        if (!$storageDisk->exists($storageDir)) {
            $storageDisk->makeDirectory($storageDir);
        }

        $attachedIds = [];
        $isFirst     = true;

        foreach ($photoUrls as $index => $url) {
            try {
                $imageResponse = \Illuminate\Support\Facades\Http::timeout(15)
                    ->withHeaders(['User-Agent' => 'Mozilla/5.0 (compatible; FarmartBot/1.0)'])
                    ->get($url);

                if (!$imageResponse->successful()) {
                    \Log::warning('Rezgo image download failed', ['url' => $url, 'status' => $imageResponse->status()]);
                    continue;
                }

                $contentType = $imageResponse->header('Content-Type');
                $ext         = match(true) {
                    str_contains((string)$contentType, 'jpeg'),
                    str_contains((string)$contentType, 'jpg')  => 'jpg',
                    str_contains((string)$contentType, 'png')  => 'png',
                    str_contains((string)$contentType, 'webp') => 'webp',
                    default => pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg',
                };

                $filename = 'rezgo-' . $product->id . '-' . ($index + 1) . '.' . $ext;
                $filepath = $storageDir . '/' . $filename;
                $storageDisk->put($filepath, $imageResponse->body());

                $fullPath = $storageDisk->path($filepath);
                $size     = @getimagesize($fullPath);

                $mediaFile = \Botble\Media\Models\MediaFile::create([
                    'name'      => $product->name . ' - Image ' . ($index + 1),
                    'url'       => $filepath,
                    'mime_type' => $contentType ?: 'image/jpeg',
                    'size'      => strlen($imageResponse->body()),
                    'width'     => $size[0] ?? 0,
                    'height'    => $size[1] ?? 0,
                    'folder_id' => 0,
                ]);

                $attachedIds[] = $mediaFile->id;

                if ($isFirst) {
                    $product->image = $filepath;
                    $product->save();
                    $isFirst = false;
                }

            } catch (\Exception $e) {
                \Log::warning('Rezgo image attachment error', ['url' => $url, 'error' => $e->getMessage()]);
            }
        }

        if (!empty($attachedIds)) {
            try {
                if (method_exists($product, 'images')) {
                    $product->images()->sync($attachedIds);
                } else {
                    $columns = \Schema::getColumnListing('ec_products');
                    if (in_array('images', $columns)) {
                        $product->images = json_encode($attachedIds);
                        $product->save();
                    }
                }
            } catch (\Exception $e) {
                \Log::warning('Rezgo: could not attach images to product', [
                    'product_id' => $product->id,
                    'error'      => $e->getMessage(),
                ]);
            }
        }
    }

    // FIX: use config() not env() throughout external sync methods
    public function showExternalSyncSettings(): View
    {
        return view('rezgo::external-sync-settings', [
            'host'     => config('rezgo.rezgo.external_sync.host', ''),
            'port'     => config('rezgo.rezgo.external_sync.port', '3306'),
            'username' => config('rezgo.rezgo.external_sync.username', ''),
            'database' => config('rezgo.rezgo.external_sync.database_name', ''),
            'enabled'  => config('rezgo.rezgo.external_sync.enabled', false),
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
```

---

## FIX 5 — HIGH: ExternalDatabaseSyncService — env() to config()

**File:** `src/Services/ExternalDatabaseSyncService.php`

Replace the entire file:

```php
<?php

namespace Botble\RezgoConnector\Services;

use Botble\RezgoConnector\Models\RezgoLog;
use PDO;

class ExternalDatabaseSyncService
{
    private ?PDO $externalDb = null;
    private RezgoApiService $api;

    public function __construct(RezgoApiService $api)
    {
        $this->api = $api;
    }

    private function getExternalDb(): ?PDO
    {
        if (!config('rezgo.rezgo.external_sync.enabled', false)) {
            return null;
        }

        if ($this->externalDb !== null) {
            return $this->externalDb;
        }

        try {
            $host     = config('rezgo.rezgo.external_sync.host');
            $port     = config('rezgo.rezgo.external_sync.port', 3306);
            $username = config('rezgo.rezgo.external_sync.username');
            $password = config('rezgo.rezgo.external_sync.password');
            $database = config('rezgo.rezgo.external_sync.database_name');

            if (!$host || !$username || !$database) {
                RezgoLog::warning('external_sync', null, 'External DB credentials missing in config');
                return null;
            }

            $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";
            $this->externalDb = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            return $this->externalDb;
        } catch (\Exception $e) {
            RezgoLog::error('external_sync', null, 'External DB connection failed: ' . $e->getMessage());
            return null;
        }
    }

    public function syncMappingToExternal(array $mappingData): bool
    {
        try {
            $pdo = $this->getExternalDb();
            if (!$pdo) return false;

            $ticketName = $mappingData['rezgo_title'] ?? '';
            $rezgoUid   = $mappingData['rezgo_uid']   ?? '';
            $rezgoPrice = $mappingData['rezgo_price']  ?? 0;

            if (!$ticketName || !$rezgoUid) {
                RezgoLog::error('external_sync', null, 'Missing rezgo_title or rezgo_uid');
                return false;
            }

            $table = config('rezgo.rezgo.external_sync.ticket_mapping_table', 'ticket_mapping');
            $sql   = "INSERT INTO `{$table}` (rezgo_uid, ticket_name, rezgo_price, available_dates, synced_at, updated_at)
                      VALUES (?, ?, ?, ?, NOW(), NOW())
                      ON DUPLICATE KEY UPDATE
                          ticket_name = VALUES(ticket_name),
                          rezgo_price = VALUES(rezgo_price),
                          available_dates = VALUES(available_dates),
                          synced_at = NOW(),
                          updated_at = NOW()";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$rezgoUid, $ticketName, $rezgoPrice, json_encode([])]);

            RezgoLog::sync('external_sync', null, "Synced to external DB: {$ticketName}");
            return true;

        } catch (\Exception $e) {
            RezgoLog::error('external_sync', null, 'Failed to sync: ' . $e->getMessage());
            return false;
        }
    }

    public function getTicketPricing(string $rezgoUid, ?string $date = null): ?array
    {
        try {
            $pdo = $this->getExternalDb();
            if (!$pdo) return null;

            $table = config('rezgo.rezgo.external_sync.ticket_pricing_table', 'ticket_pricing');
            $sql   = "SELECT * FROM `{$table}` WHERE rezgo_uid = ?";

            if ($date) {
                $sql .= " AND price_date = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$rezgoUid, $date]);
            } else {
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$rezgoUid]);
            }

            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (\Exception $e) {
            RezgoLog::error('external_sync', null, 'Error fetching pricing: ' . $e->getMessage());
            return null;
        }
    }

    public function deleteMappingFromExternal(string $rezgoUid): bool
    {
        try {
            $pdo = $this->getExternalDb();
            if (!$pdo) return false;

            $table = config('rezgo.rezgo.external_sync.ticket_mapping_table', 'ticket_mapping');
            $stmt  = $pdo->prepare("DELETE FROM `{$table}` WHERE rezgo_uid = ?");
            $stmt->execute([$rezgoUid]);

            RezgoLog::sync('external_sync', null, "Deleted from external DB: {$rezgoUid}");
            return true;
        } catch (\Exception $e) {
            RezgoLog::error('external_sync', null, 'Error deleting: ' . $e->getMessage());
            return false;
        }
    }
}
```

---

## FIX 6 — MEDIUM + FEATURE: ServiceProvider — register missing command, remove double-logger

**File:** `src/Providers/RezgoConnectorServiceProvider.php`

Replace the entire file:

```php
<?php

namespace Botble\RezgoConnector\Providers;

use Illuminate\Support\ServiceProvider;
use Botble\Ecommerce\Events\OrderPlacedEvent;
use Botble\RezgoConnector\Listeners\SubmitOrderToRezgo;
use Illuminate\Support\Facades\Event;
use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\DashboardMenuItem;

class RezgoConnectorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('rezgo.settings', function () {
            return new \Botble\RezgoConnector\Services\RezgoSettingsService();
        });

        $this->app->singleton('rezgo.api', function ($app) {
            return new \Botble\RezgoConnector\Services\RezgoApiService(
                $app->make(\Botble\RezgoConnector\Services\RezgoSettingsService::class)
            );
        });

        // RezgoLoggerService removed — it double-logged every entry.
        // Use RezgoLog::* static methods directly instead.
    }

    public function boot(): void
    {
        config(['logging.channels.rezgo' => [
            'driver' => 'daily',
            'path'   => storage_path('logs/rezgo-sync.log'),
            'level'  => 'debug',
            'days'   => 14,
        ]]);

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'rezgo');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'rezgo');

        Event::listen(OrderPlacedEvent::class, SubmitOrderToRezgo::class);

        if (class_exists('\Botble\Base\Facades\DashboardMenu')) {
            DashboardMenu::default()->beforeRetrieving(function (): void {
                DashboardMenu::make()->registerItem(
                    DashboardMenuItem::make()
                        ->id('rezgo-connector')
                        ->priority(50)
                        ->icon('ti ti-packages')
                        ->name('rezgo::messages.rezgo_connector')
                );
                DashboardMenu::make()->registerItem(
                    DashboardMenuItem::make()
                        ->id('rezgo-settings')
                        ->priority(50)
                        ->parentId('rezgo-connector')
                        ->icon('ti ti-settings')
                        ->name('Settings')
                        ->route('rezgo.index')
                );
                DashboardMenu::make()->registerItem(
                    DashboardMenuItem::make()
                        ->id('rezgo-external-sync')
                        ->priority(51)
                        ->parentId('rezgo-connector')
                        ->icon('ti ti-refresh-dot')
                        ->name('External Sync')
                        ->route('rezgo.external-sync.settings')
                );
            });
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Botble\RezgoConnector\Commands\SetupRezgoTestData::class,
                \Botble\RezgoConnector\Commands\ClearRezgoMappings::class,
                \Botble\RezgoConnector\Commands\DebugRezgoInventory::class,  // FIX: was missing
                \Botble\RezgoConnector\Commands\SyncRezgoPrices::class,      // NEW: dynamic pricing
            ]);
        }

        $this->publishes(
            [__DIR__ . '/../../config' => config_path('rezgo')],
            'rezgo-config'
        );
    }
}
```

---

## FIX 7 — MEDIUM: routes — importAsDraft GET to POST

**File:** `routes/web.php`

Replace the entire file:

```php
<?php

use Botble\RezgoConnector\Http\Controllers\RezgoConnectorController;
use Botble\Base\Facades\AdminHelper;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function (): void {
    Route::group(['prefix' => 'rezgo-connector', 'as' => 'rezgo.'], function (): void {
        Route::get('/', [RezgoConnectorController::class, 'index'])->name('index');
        Route::post('/settings', [RezgoConnectorController::class, 'updateSettings'])->name('settings.update');
        Route::get('/test-connection', [RezgoConnectorController::class, 'testConnection'])->name('test-connection');
        Route::get('/sync-inventory', [RezgoConnectorController::class, 'syncInventory'])->name('sync-inventory');
        Route::get('/submit-order', [RezgoConnectorController::class, 'showSubmitOrderForm'])->name('submit-order.form');
        Route::post('/submit-order', [RezgoConnectorController::class, 'submitOrder'])->name('submit-order');

        Route::prefix('submissions')->as('submissions.')->group(function () {
            Route::get('/', [RezgoConnectorController::class, 'submissions'])->name('index');
            Route::get('{id}', [RezgoConnectorController::class, 'submissionDetail'])->name('detail');
        });

        Route::prefix('product-mappings')->as('product-mappings.')->group(function () {
            Route::get('/', [RezgoConnectorController::class, 'productMappings'])->name('index');
            Route::post('/', [RezgoConnectorController::class, 'saveProductMapping'])->name('save');
            Route::delete('{id}', [RezgoConnectorController::class, 'deleteProductMapping'])->name('delete');
        });

        // FIX: changed from GET to POST
        Route::post('/import-as-draft', [RezgoConnectorController::class, 'importAsDraft'])->name('import-as-draft');

        Route::prefix('external-sync')->as('external-sync.')->group(function () {
            Route::get('/', [RezgoConnectorController::class, 'showExternalSyncSettings'])->name('settings');
            Route::post('/save', [RezgoConnectorController::class, 'saveExternalSyncSettings'])->name('save');
            Route::post('/test-connection', [RezgoConnectorController::class, 'testExternalConnection'])->name('test-connection');
            Route::post('/create-tables', [RezgoConnectorController::class, 'createExternalTables'])->name('create-tables');
            Route::post('/table-status', [RezgoConnectorController::class, 'getExternalTableStatus'])->name('table-status');
        });

        Route::prefix('logs')->as('logs.')->group(function () {
            Route::get('/', [RezgoConnectorController::class, 'logs'])->name('index');
        });
    });
});
```

---

## FIX 8 — MEDIUM: SetupRezgoTestData — wrong field name

**File:** `src/Commands/SetupRezgoTestData.php`

Find this block inside `fetchAndSelectTours()`:

```php
foreach ($items as $tour) {
    $name = strtolower($tour['tour_name'] ?? '');
```

Replace with:

```php
foreach ($items as $tour) {
    $name = strtolower($tour['name'] ?? $tour['item'] ?? $tour['tour_name'] ?? '');
```

Find this line in the same method:

```php
$this->line("    " . ($idx + 1) . ". " . $tour['tour_name']);
```

Replace with:

```php
$this->line("    " . ($idx + 1) . ". " . ($tour['name'] ?? $tour['item'] ?? $tour['uid'] ?? 'Unknown'));
```

Also find `createProducts()` and locate:

```php
$tourName = $tour['name'] ?? $tour['item'] ?? $tour['tour_name'] ?? 'Tour';
```

If that line already reads `$tour['tour_name']` only, replace the entire line with the version above.

---

## FIX 9 — BLADE: import-as-draft button POST form + error/paginator display

**File:** `resources/views/admin/product-mappings.blade.php`

Find the Import as Draft anchor tag (will look something like):

```html
<a href="{{ route('rezgo.import-as-draft') }}?rezgo_uid=...">Import as Draft</a>
```

Replace it with:

```html
<form method="POST" action="{{ route('rezgo.import-as-draft') }}" style="display:inline">
    @csrf
    <input type="hidden" name="rezgo_uid" value="{{ $tour['uid'] ?? '' }}">
    <input type="hidden" name="rezgo_title" value="{{ $tour['display_name'] ?? $tour['item'] ?? $tour['name'] ?? '' }}">
    <button type="submit" class="btn btn-sm btn-info">Import as Draft</button>
</form>
```

Find where inventory items are listed and add this error block immediately above the table:

```blade
@if (!empty($inventoryError))
    <div class="alert alert-danger">
        Rezgo inventory could not be loaded: {{ $inventoryError }}
    </div>
@endif
```

Find where inventory pagination is rendered (or add it below the inventory table) and replace/add:

```blade
@if ($retzgoPaginator && $retzgoPaginator->hasPages())
    <div class="mt-2">{{ $retzgoPaginator->links() }}</div>
@endif
```

---

## NEW FEATURE — Dynamic Pricing Sync Command

**Action:** Create a new file at this path:

**File:** `src/Commands/SyncRezgoPrices.php`

```php
<?php

namespace Botble\RezgoConnector\Commands;

use Illuminate\Console\Command;
use Botble\RezgoConnector\Models\{RezgoProductMapping, RezgoLog};
use Botble\RezgoConnector\Services\{RezgoApiService, ExternalDatabaseSyncService};
use Illuminate\Support\Facades\DB;
use PDO;

class SyncRezgoPrices extends Command
{
    protected $signature   = 'rezgo:sync-prices {--dry-run : Show what would change without saving}';
    protected $description = 'Fetch current prices from Rezgo and update mapped Farmart products and external DB';

    private RezgoApiService $api;
    private ExternalDatabaseSyncService $externalSync;

    public function __construct(RezgoApiService $api, ExternalDatabaseSyncService $externalSync)
    {
        parent::__construct();
        $this->api          = $api;
        $this->externalSync = $externalSync;
    }

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');

        $this->line('');
        $this->line('══════════════════════════════════════════════');
        $this->line('  REZGO PRICE SYNC' . ($dryRun ? ' [DRY RUN]' : ''));
        $this->line('══════════════════════════════════════════════');
        $this->newLine();

        // Fetch all active mappings
        $mappings = RezgoProductMapping::where('is_active', true)
            ->whereNotNull('rezgo_uid')
            ->get();

        if ($mappings->isEmpty()) {
            $this->warn('No active Rezgo product mappings found. Nothing to sync.');
            return Command::SUCCESS;
        }

        $this->info("Found {$mappings->count()} active mappings to check.");
        $this->newLine();

        $updated  = 0;
        $skipped  = 0;
        $failed   = 0;
        $errors   = [];

        foreach ($mappings as $mapping) {
            $uid         = $mapping->rezgo_uid;
            $productId   = $mapping->product_id;
            $productName = $mapping->rezgo_title ?? "Product #{$productId}";

            $this->line("Checking: {$productName} (UID: {$uid})");

            // Fetch full item from Rezgo
            $itemResponse = $this->api->getItemFull($uid);

            if (!$itemResponse['success'] || empty($itemResponse['data'])) {
                $this->error("  ✗ Failed to fetch from Rezgo: " . ($itemResponse['error'] ?? 'unknown'));
                RezgoLog::error('sync_prices', $productId, "Failed to fetch item {$uid}: " . ($itemResponse['error'] ?? 'unknown'));
                $failed++;
                $errors[] = $productName;
                continue;
            }

            $itemData  = $itemResponse['data'];
            $allPrices = $this->api->extractAllPrices($itemData);
            $newPrice  = $allPrices['adult'] ?? 0.00;

            if ($newPrice <= 0) {
                $this->warn("  ⚠ No valid price returned for {$productName}, skipping.");
                $skipped++;
                continue;
            }

            $currentProduct = DB::table('ec_products')->where('id', $productId)->first();
            $currentPrice   = $currentProduct ? (float)$currentProduct->price : null;

            if ($currentPrice === null) {
                $this->warn("  ⚠ Product #{$productId} not found in ec_products, skipping.");
                $skipped++;
                continue;
            }

            $priceChanged = abs($newPrice - $currentPrice) > 0.01;

            if (!$priceChanged) {
                $this->line("  ✓ No change (price: \${$currentPrice})");
                $skipped++;
                continue;
            }

            $this->line("  → Price change: \${$currentPrice} → \${$newPrice}");

            if (!$dryRun) {
                // Update Farmart product price
                DB::table('ec_products')
                    ->where('id', $productId)
                    ->update(['price' => $newPrice, 'updated_at' => now()]);

                // Update mapping rezgo_price
                $mapping->update([
                    'rezgo_price' => $newPrice,
                    'sell_price'  => $newPrice,
                ]);

                // Sync to external database if enabled
                if (config('rezgo.rezgo.external_sync.enabled', false)) {
                    $this->syncPriceToExternalDb($uid, $productName, $newPrice, $allPrices);
                }

                RezgoLog::sync('sync_prices', $productId, "Price updated: \${$currentPrice} → \${$newPrice}", [
                    'rezgo_uid' => $uid,
                    'old_price' => $currentPrice,
                    'new_price' => $newPrice,
                    'all_prices' => $allPrices,
                ]);
            }

            $updated++;
        }

        $this->newLine();
        $this->line('══════════════════════════════════════════════');
        $this->info("Sync complete" . ($dryRun ? ' [DRY RUN — no changes saved]' : ''));
        $this->line("  Updated : {$updated}");
        $this->line("  No change: {$skipped}");
        $this->line("  Failed  : {$failed}");

        if (!empty($errors)) {
            $this->newLine();
            $this->warn("Failed items:");
            foreach ($errors as $e) {
                $this->warn("  - {$e}");
            }
        }

        $this->line('');
        return Command::SUCCESS;
    }

    /**
     * Write per-type prices to the external database ticket_pricing table.
     * One row per passenger type per sync date.
     */
    private function syncPriceToExternalDb(string $rezgoUid, string $ticketName, float $adultPrice, array $allPrices): void
    {
        try {
            $host     = config('rezgo.rezgo.external_sync.host');
            $port     = config('rezgo.rezgo.external_sync.port', 3306);
            $username = config('rezgo.rezgo.external_sync.username');
            $password = config('rezgo.rezgo.external_sync.password');
            $database = config('rezgo.rezgo.external_sync.database_name');

            if (!$host || !$username || !$database) {
                return;
            }

            $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";
            $pdo = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $mappingTable = config('rezgo.rezgo.external_sync.ticket_mapping_table', 'ticket_mapping');
            $pricingTable = config('rezgo.rezgo.external_sync.ticket_pricing_table', 'ticket_pricing');
            $today        = date('Y-m-d');

            // Upsert the ticket_mapping row first (foreign key dependency)
            $stmt = $pdo->prepare(
                "INSERT INTO `{$mappingTable}` (rezgo_uid, ticket_name, rezgo_price, synced_at, updated_at)
                 VALUES (?, ?, ?, NOW(), NOW())
                 ON DUPLICATE KEY UPDATE
                     ticket_name = VALUES(ticket_name),
                     rezgo_price = VALUES(rezgo_price),
                     synced_at   = NOW(),
                     updated_at  = NOW()"
            );
            $stmt->execute([$rezgoUid, $ticketName, $adultPrice]);

            // Upsert one pricing row per passenger type
            $pricingStmt = $pdo->prepare(
                "INSERT INTO `{$pricingTable}` (rezgo_uid, price_date, current_price, updated_at)
                 VALUES (?, ?, ?, NOW())
                 ON DUPLICATE KEY UPDATE
                     current_price = VALUES(current_price),
                     updated_at    = NOW()"
            );

            foreach ($allPrices as $type => $price) {
                if ($price > 0) {
                    // Store type in price_date field as type-prefixed date: "adult-2026-05-01"
                    // This lets the external app query by type and date separately
                    $pricingStmt->execute([$rezgoUid, $type . '-' . $today, $price]);
                }
            }

        } catch (\Exception $e) {
            RezgoLog::error('sync_prices', null, 'External DB price sync failed: ' . $e->getMessage());
        }
    }
}
```

---

## NEW FEATURE — Scheduled Price Sync (Laravel Scheduler)

**Action:** Open the file `app/Console/Kernel.php` in the main Farmart application (NOT inside the plugin).

Find the `schedule()` method and add this line inside it:

```php
$schedule->command('rezgo:sync-prices')->dailyAt('03:00');
```

Full example of what the method should look like after editing:

```php
protected function schedule(Schedule $schedule): void
{
    // ... existing schedule entries ...

    // Rezgo price sync — runs every day at 3am
    $schedule->command('rezgo:sync-prices')->dailyAt('03:00');
}
```

**To verify the scheduler is running on the server:**

```bash
# Check crontab for the Laravel scheduler entry
crontab -l

# It should contain a line like:
# * * * * * cd /path/to/farmart && php artisan schedule:run >> /dev/null 2>&1
# If not, add it:
(crontab -l 2>/dev/null; echo "* * * * * cd /var/www/farmart/main && php artisan schedule:run >> /dev/null 2>&1") | crontab -
```

**To run a manual price sync immediately:**

```bash
# Dry run first — shows what would change without saving anything
php artisan rezgo:sync-prices --dry-run

# Live run
php artisan rezgo:sync-prices
```

---

## POST-DEPLOY CHECKLIST

Run all of these on the server after every file above is in place:

```bash
# 1. Clear all caches
php artisan config:cache
php artisan route:cache
php artisan view:clear

# 2. Confirm all three commands are registered
php artisan list | grep rezgo

# Expected output:
#   rezgo:clear-mappings
#   rezgo:debug-inventory
#   rezgo:setup-test-data
#   rezgo:sync-prices

# 3. Dry-run price sync to confirm it connects and reads Rezgo correctly
php artisan rezgo:sync-prices --dry-run

# 4. Debug inventory to confirm field names Rezgo returns
php artisan rezgo:debug-inventory

# 5. Tail logs during first live import-as-draft test
tail -f storage/logs/laravel.log | grep -i rezgo
```

---

## NOTES FOR THE AGENT

- Do not delete any migration files.
- Do not modify any blade view files except product-mappings as described in FIX 9.
- Do not rename any classes or namespaces.
- SyncRezgoPrices.php is a brand new file — it does not replace anything.
- The scheduler entry goes in the main app Kernel.php, not inside the plugin.
- If image attachment fails silently, check that `Botble\Media\Models\MediaFile` exists
  in the installed version of Farmart. If not, remove the MediaFile::create() block
  and keep only the $product->image = $filepath assignment.
