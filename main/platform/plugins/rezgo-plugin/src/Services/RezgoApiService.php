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
            RezgoLog::sync('commit_booking', $orderId, 'XML Payload: ' . $xmlPayload);

            $response = Http::timeout(30)
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
                RezgoLog::sync('commit_booking', $orderId, 'Booking successful - Transaction #' . $transNum, ['trans_num' => $transNum]);
                return [
                    'success'   => true,
                    'status'    => 200,
                    'data'      => $responseData,
                    'trans_num' => $transNum,
                    'message'   => 'Booking complete',
                ];
            }

            // Rezgo returns errors in <e> tag, not <error> or <message>
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
     * This fetches full item data with description, photos, and pricing tiers.
     */
    public function getItemFull(string $uid): array
    {
        if (!$this->settings->isConfigured()) {
            return ['success' => false, 'error' => 'API not configured'];
        }

        try {
            $cid = $this->settings->getCid();
            $apiKey = $this->settings->getApiKey();

            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml .= '<request>' . PHP_EOL;
            $xml .= '  <transcode>' . htmlspecialchars($cid) . '</transcode>' . PHP_EOL;
            $xml .= '  <key>' . htmlspecialchars($apiKey) . '</key>' . PHP_EOL;
            $xml .= '  <instruction>search</instruction>' . PHP_EOL;
            $xml .= '  <uid>' . htmlspecialchars($uid) . '</uid>' . PHP_EOL;
            $xml .= '</request>' . PHP_EOL;

            RezgoLog::sync('get_item_full', null, 'Request XML: ' . $xml);

            $response = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/xml'])
                ->withBody($xml, 'application/xml')
                ->post($this->baseUrl);

            $responseBody = $response->body();
            RezgoLog::sync('get_item_full', null, 'Raw response body: ' . substr($responseBody, 0, 500));

            $responseData = $this->parseXmlResponse($responseBody);
            
            // Rezgo search instruction with UID returns item in various formats
            // Try multiple possible keys
            $item = null;
            
            if (isset($responseData['item'])) {
                $item = $responseData['item'];
            } elseif (isset($responseData['tour'])) {
                $item = $responseData['tour'];
            } elseif (isset($responseData['inventory'])) {
                $item = $responseData['inventory'];
            } elseif (is_array($responseData) && !empty($responseData)) {
                // If response is array of items, get first one
                foreach ($responseData as $key => $value) {
                    if (is_array($value) && !is_numeric($key)) {
                        $item = $value;
                        break;
                    }
                }
            }
            
            // Handle multiple items array
            if (is_array($item) && isset($item[0]) && is_array($item[0])) {
                $item = $item[0];
            }
            
            if ($item) {
                RezgoLog::sync('get_item_full', null, 'Item found, keys: ' . implode(',', array_keys((array)$item)));
                return ['success' => true, 'data' => $item];
            }

            RezgoLog::error('get_item_full', null, 'Item not found in response for uid: ' . $uid . ' | Response keys: ' . implode(',', array_keys((array)$responseData)));
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
     * Checks multiple possible field names where Rezgo stores description data.
     */
    public function extractDescription(array $itemData): string
    {
        // First priority: direct fields
        $fields = ['desc', 'description', 'details', 'overview', 'highlights', 'inclusions', 'notes', 'content', 'tour_desc'];
        
        foreach ($fields as $field) {
            if (!empty($itemData[$field])) {
                $value = $itemData[$field];
                // If it's an array, join it
                if (is_array($value)) {
                    // Filter out empty values and arrays
                    $value = array_filter($value, function($v) {
                        return !is_array($v) && !empty(trim((string)$v));
                    });
                    if (!empty($value)) {
                        $value = implode(' ', $value);
                    }
                }
                if (!empty($value)) {
                    return trim((string)$value);
                }
            }
        }

        // Second priority: nested details object
        if (!empty($itemData['details'])) {
            $details = $itemData['details'];
            if (is_array($details)) {
                $nestedFields = ['description', 'overview', 'content', 'tour_desc', 'desc'];
                foreach ($nestedFields as $field) {
                    if (!empty($details[$field])) {
                        $value = $details[$field];
                        if (is_array($value)) {
                            $value = implode(' ', array_filter($value, 'is_string'));
                        }
                        if (!empty($value)) {
                            return trim((string)$value);
                        }
                    }
                }
            }
        }

        return '';
    }

    /**
     * Extract the best available price from item data.
     * Checks multiple field names where prices can be stored.
     */
    public function extractPrice(array $itemData, ?string $uid = null): float
    {
        $directFields = ['price', 'rate', 'rate_period', 'adult_price', 'cost', 'starting'];
        
        foreach ($directFields as $field) {
            if (!empty($itemData[$field])) {
                $value = $itemData[$field];
                if (is_array($value)) {
                    $value = reset($value);
                }
                $price = (float)$value;
                if ($price > 0) {
                    return $price;
                }
            }
        }

        // Check nested price_list for per-passenger pricing
        if (!empty($itemData['price_list'])) {
            $priceList = $itemData['price_list'];
            
            // Handle single price entry
            if (!isset($priceList[0])) {
                $priceList = [$priceList];
            }

            // Find first valid price
            foreach ($priceList as $entry) {
                if (is_array($entry) && !empty($entry['price'])) {
                    $price = (float)$entry['price'];
                    if ($price > 0) {
                        return $price;
                    }
                }
            }
        }

        // Fallback: Try to fetch dynamic price from today onwards
        if ($uid && $this->settings->isConfigured()) {
            try {
                // Try to get price for today or first available date in next 30 days
                for ($i = 0; $i < 30; $i++) {
                    $checkDate = date('Y-m-d', strtotime("+{$i} days"));
                    $pricingResult = $this->getPricingByDate($uid, $checkDate);
                    
                    if ($pricingResult['success'] && $pricingResult['price_adult'] > 0) {
                        return $pricingResult['price_adult'];
                    }
                }
            } catch (\Exception $e) {
                // If dynamic pricing fails, return 0 (will use fallback)
            }
        }

        return 0.00;
    }

    /**
     * Extract all per-type prices as an array (used by dynamic pricing sync).
     */
    public function extractAllPrices(array $itemData): array
    {
        $result = ['adult' => 0.00, 'child' => 0.00, 'senior' => 0.00];

        if (empty($itemData['price_list'])) {
            return $result;
        }

        $priceList = $itemData['price_list'];
        if (!isset($priceList[0])) {
            $priceList = [$priceList];
        }

        foreach ($priceList as $entry) {
            if (!is_array($entry)) {
                continue;
            }

            $type = strtolower($entry['type'] ?? $entry['passenger_type'] ?? '');
            $price = (float)($entry['price'] ?? 0);

            if ($price > 0) {
                if (strpos($type, 'adult') !== false || strpos($type, 'regular') !== false) {
                    $result['adult'] = $price;
                } elseif (strpos($type, 'child') !== false) {
                    $result['child'] = $price;
                } elseif (strpos($type, 'senior') !== false) {
                    $result['senior'] = $price;
                }
            }
        }

        return $result;
    }

    /**
     * Extract photo URLs from item data.
     * Returns up to 5 URLs suitable for Farmart product gallery.
     */
    public function extractPhotoUrls(array $itemData): array
    {
        $cid = $this->settings->getCid();
        $urls = [];

        // Check featured photo
        if (!empty($itemData['featured_photo'])) {
            $urls[] = $this->buildPhotoUrl($itemData['featured_photo'], $cid);
        }

        // Check images field (common in newer Rezgo responses)
        if (!empty($itemData['images'])) {
            $images = $itemData['images'];
            if (!isset($images[0])) {
                $images = [$images];
            }
            foreach ($images as $img) {
                if (is_array($img)) {
                    if (!empty($img['url'])) {
                        $urls[] = $img['url'];
                    } elseif (!empty($img['filename'])) {
                        $urls[] = $this->buildPhotoUrl($img['filename'], $cid);
                    } elseif (!empty($img['image'])) {
                        $urls[] = $this->buildPhotoUrl($img['image'], $cid);
                    }
                } elseif (!empty($img)) {
                    $urls[] = $this->buildPhotoUrl($img, $cid);
                }
            }
        }

        // Check media field
        if (!empty($itemData['media'])) {
            $media = $itemData['media'];
            
            // Handle media as array of items
            if (is_array($media)) {
                // Check for associative array with 'image' key (common Rezgo structure)
                if (isset($media['image'])) {
                    $img = $media['image'];
                    if (is_array($img)) {
                        if (!empty($img['path'])) {
                            $urls[] = $this->buildPhotoUrl($img['path'], $cid);
                        } elseif (!empty($img['url'])) {
                            $urls[] = $img['url'];
                        }
                    } elseif (!empty($img)) {
                        $urls[] = $this->buildPhotoUrl($img, $cid);
                    }
                }
                // Also check for indexed array format
                elseif (!isset($media['total'])) {  // 'total' is metadata, not content
                    if (!isset($media[0])) {
                        $media = [$media];
                    }
                    foreach ($media as $mediaItem) {
                        if (is_array($mediaItem) && !empty($mediaItem['url'])) {
                            $urls[] = $mediaItem['url'];
                        } elseif (is_string($mediaItem) && !empty($mediaItem)) {
                            $urls[] = $this->buildPhotoUrl($mediaItem, $cid);
                        }
                    }
                }
            }
        }

        // Check direct photo fields
        if (!empty($itemData['photo'])) {
            $photos = $itemData['photo'];
            if (!isset($photos[0])) {
                $photos = [$photos];
            }
            foreach ($photos as $photo) {
                if (is_array($photo) && !empty($photo['filename'])) {
                    $urls[] = $this->buildPhotoUrl($photo['filename'], $cid);
                } elseif (is_string($photo) && !empty($photo)) {
                    $urls[] = $this->buildPhotoUrl($photo, $cid);
                }
            }
        }

        // Check nested gallery or details images
        if (!empty($itemData['gallery']) && is_array($itemData['gallery'])) {
            $gallery = $itemData['gallery'];
            if (!isset($gallery[0])) {
                $gallery = [$gallery];
            }
            foreach ($gallery as $item) {
                if (is_array($item) && !empty($item['photo'])) {
                    $urls[] = $this->buildPhotoUrl($item['photo'], $cid);
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

        // BOOKING block - correct Rezgo field names
        $xml .= '  <booking>' . PHP_EOL;
        $xml .= '    <book>' . $uid  . '</book>' . PHP_EOL;
        $xml .= '    <date>' . $date . '</date>' . PHP_EOL;
        if ($numAdults > 0)   $xml .= '    <adult_num>'  . $numAdults   . '</adult_num>'  . PHP_EOL;
        if ($numChildren > 0) $xml .= '    <child_num>'  . $numChildren . '</child_num>'  . PHP_EOL;
        if ($numSeniors > 0)  $xml .= '    <senior_num>' . $numSeniors  . '</senior_num>' . PHP_EOL;
        $xml .= '  </booking>' . PHP_EOL;

        // PAYMENT block - customer info uses tour_* prefix, payment_method Cash for test
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
    private function parseXmlResponse(string $xmlBody)
    {
        try {
            $xml = simplexml_load_string($xmlBody, null, LIBXML_NOCDATA);
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
     * which discarded children when text content existed. Now properly handles both.
     */
    private function xmlToArray($xml)
    {
        if (is_string($xml)) {
            return $xml;
        }

        $array = [];

        foreach ($xml->children() as $name => $child) {
            $textContent = trim((string)$child);
            $children = $child->children();
            
            // If has children, recurse; else use text content
            $value = count($children) > 0 ? $this->xmlToArray($child) : $textContent;
            
            if (isset($array[$name])) {
                if (!is_array($array[$name]) || !isset($array[$name][0])) {
                    $array[$name] = [$array[$name]];
                }
                $array[$name][] = $value;
            } else {
                $array[$name] = $value;
            }
        }

        if ($xml->attributes()) {
            foreach ($xml->attributes() as $name => $value) {
                $array['@' . $name] = (string)$value;
            }
        }

        return $array ?: (string)$xml;
    }

    // =========================================================================
    // DYNAMIC PRICING
    // =========================================================================

    /**
     * Get price for a specific UID and date.
     * Uses GET query param format which returns per-date pricing blocks.
     * Returns: ['success' => bool, 'price_adult' => float, 'price_child' => float, 'available' => bool]
     */
    public function getPricingByDate(string $uid, string $date): array
    {
        if (!$this->settings->isConfigured()) {
            return ['success' => false, 'error' => 'API not configured'];
        }

        // Cache pricing data for 1 hour to avoid repeated API calls
        $cacheKey = 'rezgo_price_' . $uid . '_' . $date;
        $cached = \Illuminate\Support\Facades\Cache::get($cacheKey);
        if ($cached) {
            return $cached;
        }

        try {
            $cid    = $this->settings->getCid();
            $apiKey = $this->settings->getApiKey();

            $url = $this->baseUrl
                . '?transcode=' . urlencode($cid)
                . '&key='       . urlencode($apiKey)
                . '&i=search'
                . '&t=uid'
                . '&q='         . urlencode($uid)
                . '&d='         . urlencode($date);

            $response = Http::timeout(10)->get($url);
            $data     = $this->parseXmlResponse($response->body());

            // Rezgo returns item > date block with per-date pricing
            $item = $data['item'] ?? $data['tour'] ?? null;

            if (!$item) {
                return ['success' => false, 'error' => 'Item not found'];
            }

            $dateBlock = $item['date'] ?? null;

            // When multiple dates returned, find the matching one
            if ($dateBlock && isset($dateBlock[0])) {
                foreach ($dateBlock as $block) {
                    if (isset($block['@value']) && $block['@value'] === $date) {
                        $dateBlock = $block;
                        break;
                    }
                }
            }

            if (!$dateBlock || !is_array($dateBlock)) {
                return ['success' => false, 'error' => 'No pricing data for this date'];
            }

            $active       = ($dateBlock['active'] ?? '0') == '1';
            $priceAdult   = (float)($dateBlock['price_adult']  ?? 0);
            $priceChild   = (float)($dateBlock['price_child']  ?? 0);
            $priceSenior  = (float)($dateBlock['price_senior'] ?? 0);
            $availability = (int)($dateBlock['availability']   ?? 0);

            $result = [
                'success'      => true,
                'date'         => $date,
                'available'    => $active && $priceAdult > 0,
                'availability' => $availability,
                'price_adult'  => $priceAdult,
                'price_child'  => $priceChild,
                'price_senior' => $priceSenior,
            ];

            // Cache successful results for 1 hour
            \Illuminate\Support\Facades\Cache::put($cacheKey, $result, 3600);

            return $result;

        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get pricing for every day in a given month using parallel requests.
     * Used to populate the calendar. Makes concurrent HTTP requests for speed.
     * Returns: ['success' => bool, 'dates' => [['date'=>'Y-m-d','price_adult'=>float,'available'=>bool], ...]]
     */
    public function getPricingForMonth(string $uid, int $year, int $month): array
    {
        if (!$this->settings->isConfigured()) {
            return ['success' => false, 'error' => 'API not configured'];
        }

        try {
            $lastDay = (int)date('t', mktime(0, 0, 0, $month, 1, $year));
            $cid    = $this->settings->getCid();
            $apiKey = $this->settings->getApiKey();

            // Build all requests for parallel execution
            $requests = [];
            $dateStrs = [];
            
            for ($day = 1; $day <= $lastDay; $day++) {
                $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                $dateStrs[$dateStr] = true;
                
                // Check cache first to reduce concurrent requests
                $cacheKey = 'rezgo_price_' . $uid . '_' . $dateStr;
                $cached = \Illuminate\Support\Facades\Cache::get($cacheKey);
                if ($cached) {
                    continue; // Skip cached items from concurrent requests
                }
                
                // Build URL for this date
                $url = $this->baseUrl
                    . '?transcode=' . urlencode($cid)
                    . '&key='       . urlencode($apiKey)
                    . '&i=search'
                    . '&t=uid'
                    . '&q='         . urlencode($uid)
                    . '&d='         . urlencode($dateStr);
                
                $requests[$dateStr] = $url;
            }

            // Execute all non-cached requests in parallel (max 5 concurrent)
            $responses = [];
            $chunkSize = 5;
            $chunks = array_chunk($requests, $chunkSize, true);
            
            foreach ($chunks as $chunk) {
                $poolRequests = [];
                foreach ($chunk as $dateStr => $url) {
                    $poolRequests[$dateStr] = Http::timeout(10)->get($url);
                }
                $responses = array_merge($responses, $poolRequests);
            }

            // Process results from cache + parallel requests
            $dates = [];
            
            for ($day = 1; $day <= $lastDay; $day++) {
                $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                
                // Try cache first
                $cacheKey = 'rezgo_price_' . $uid . '_' . $dateStr;
                $cached = \Illuminate\Support\Facades\Cache::get($cacheKey);
                if ($cached) {
                    $dates[] = $cached;
                    continue;
                }
                
                // Check response from parallel requests
                if (isset($responses[$dateStr])) {
                    $response = $responses[$dateStr];
                    $data = $this->parseXmlResponse($response->body());
                    $item = $data['item'] ?? $data['tour'] ?? null;
                    
                    if ($item && ($dateBlock = $item['date'] ?? null)) {
                        if (isset($dateBlock[0])) {
                            foreach ($dateBlock as $block) {
                                if (isset($block['@value']) && $block['@value'] === $dateStr) {
                                    $dateBlock = $block;
                                    break;
                                }
                            }
                        }
                        
                        if (is_array($dateBlock)) {
                            $active = ($dateBlock['active'] ?? '0') == '1';
                            $priceAdult = (float)($dateBlock['price_adult'] ?? 0);
                            
                            $result = [
                                'date'         => $dateStr,
                                'available'    => $active && $priceAdult > 0,
                                'availability' => (int)($dateBlock['availability'] ?? 0),
                                'price_adult'  => $priceAdult,
                                'price_child'  => (float)($dateBlock['price_child'] ?? 0),
                                'price_senior' => (float)($dateBlock['price_senior'] ?? 0),
                            ];
                            
                            \Illuminate\Support\Facades\Cache::put($cacheKey, $result, 3600);
                            $dates[] = $result;
                            continue;
                        }
                    }
                }
                
                // Fallback for failed requests
                $dates[] = [
                    'date'         => $dateStr,
                    'available'    => false,
                    'availability' => 0,
                    'price_adult'  => 0,
                    'price_child'  => 0,
                    'price_senior' => 0,
                ];
            }

            return [
                'success' => true,
                'uid'     => $uid,
                'year'    => $year,
                'month'   => $month,
                'dates'   => $dates,
            ];

        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}

