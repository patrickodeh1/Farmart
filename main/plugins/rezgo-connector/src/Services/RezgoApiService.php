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

    /**
     * Commit a booking to Rezgo via POST XML
     */
    public function commitBooking(array $bookingData): array
    {
        if (!$this->settings->isConfigured()) {
            $error = 'Rezgo API not configured. Please add CID and API Key in settings.';
            RezgoLog::error('commit_booking', null, $error);
            return [
                'success' => false,
                'error' => $error,
                'status' => 0,
            ];
        }

        try {
            $orderId = $bookingData['order_id'] ?? null;
            $xmlPayload = $this->buildCommitXmlPayload($bookingData);

            $logData = $bookingData;
            unset($logData['key']);
            RezgoLog::sync('commit_booking', $orderId, 'Submitting booking via POST XML', $logData);

            $response = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/xml'])
                ->withBody($xmlPayload, 'application/xml')
                ->post($this->baseUrl);

            $responseBody = $response->body();
            RezgoLog::sync('commit_booking', $orderId, 'Got response: ' . substr($responseBody, 0, 500));
            
            $responseData = $this->parseXmlResponse($responseBody);

            if (!is_array($responseData)) {
                $responseData = ['content' => $responseData];
            }

            // Check for success in XML response - typically status = 1 means success
            $isSuccess = isset($responseData['status']) && $responseData['status'] == 1;
            
            if ($isSuccess) {
                $transNum = $responseData['trans_num'] ?? $responseData['booking_id'] ?? null;
                RezgoLog::sync('commit_booking', $orderId, 'Booking successful - Transaction #' . $transNum, ['trans_num' => $transNum]);
                return [
                    'success' => true,
                    'status' => 200,
                    'data' => $responseData,
                    'trans_num' => $transNum,
                    'message' => 'Booking complete'
                ];
            }

            $error = $responseData['error'] ?? $responseData['message'] ?? 'No success status from Rezgo';
            $errorCode = $responseData['error_code'] ?? 'N/A';
            RezgoLog::error('commit_booking', $orderId, "Booking failed [$errorCode]: " . $error, $responseData);
            return [
                'success' => false,
                'status' => $response->status(),
                'error' => $error,
                'error_code' => $errorCode,
                'data' => $responseData
            ];

        } catch (\Exception $e) {
            RezgoLog::error('commit_booking', $bookingData['order_id'] ?? null, 'API request failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage(), 'status' => 0];
        }
    }

    /**
     * Build XML payload for booking commit
     */
    private function buildCommitXmlPayload(array $bookingData): string
    {
        $cid = $this->settings->getCid();
        $apiKey = $this->settings->getApiKey();
        
        // Extract data
        $uid = $bookingData['book'] ?? '';
        $date = $bookingData['date'] ?? date('Y-m-d');
        $numAdults = (int)($bookingData['adult_num'] ?? 0);
        $numChildren = (int)($bookingData['child_num'] ?? 0);
        $numSeniors = (int)($bookingData['senior_num'] ?? 0);
        
        // Contact info
        $firstName = $bookingData['tour_first_name'] ?? 'Guest';
        $lastName = $bookingData['tour_last_name'] ?? 'Booking';
        $email = $bookingData['tour_email_address'] ?? 'test@example.com';
        $phone = $bookingData['tour_phone_number'] ?? '555-0000';
        $address = $bookingData['tour_address_1'] ?? '';
        $city = $bookingData['tour_city'] ?? '';
        $state = $bookingData['tour_stateprov'] ?? '';
        $postal = $bookingData['tour_postal_code'] ?? '';
        $country = $bookingData['tour_country'] ?? 'US';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<request>' . PHP_EOL;
        $xml .= '  <transcode>' . htmlspecialchars($cid) . '</transcode>' . PHP_EOL;
        $xml .= '  <key>' . htmlspecialchars($apiKey) . '</key>' . PHP_EOL;
        $xml .= '  <instruction>commit</instruction>' . PHP_EOL;
        $xml .= '  <cart>' . PHP_EOL;
        $xml .= '    <item>' . PHP_EOL;
        $xml .= '      <uid>' . htmlspecialchars($uid) . '</uid>' . PHP_EOL;
        $xml .= '      <date>' . htmlspecialchars($date) . '</date>' . PHP_EOL;
        if ($numAdults > 0) {
            $xml .= '      <num_adults>' . $numAdults . '</num_adults>' . PHP_EOL;
        }
        if ($numChildren > 0) {
            $xml .= '      <num_children>' . $numChildren . '</num_children>' . PHP_EOL;
        }
        if ($numSeniors > 0) {
            $xml .= '      <num_seniors>' . $numSeniors . '</num_seniors>' . PHP_EOL;
        }
        $xml .= '    </item>' . PHP_EOL;
        $xml .= '  </cart>' . PHP_EOL;
        
        // Customer payment/billing info
        $xml .= '  <customer>' . PHP_EOL;
        $xml .= '    <first_name>' . htmlspecialchars($firstName) . '</first_name>' . PHP_EOL;
        $xml .= '    <last_name>' . htmlspecialchars($lastName) . '</last_name>' . PHP_EOL;
        $xml .= '    <email>' . htmlspecialchars($email) . '</email>' . PHP_EOL;
        $xml .= '    <phone>' . htmlspecialchars($phone) . '</phone>' . PHP_EOL;
        if ($address) $xml .= '    <address>' . htmlspecialchars($address) . '</address>' . PHP_EOL;
        if ($city) $xml .= '    <city>' . htmlspecialchars($city) . '</city>' . PHP_EOL;
        if ($state) $xml .= '    <province>' . htmlspecialchars($state) . '</province>' . PHP_EOL;
        if ($postal) $xml .= '    <postal_code>' . htmlspecialchars($postal) . '</postal_code>' . PHP_EOL;
        if ($country) $xml .= '    <country>' . htmlspecialchars($country) . '</country>' . PHP_EOL;
        $xml .= '  </customer>' . PHP_EOL;
        
        // Special flag - this is test booking, use test payment
        $xml .= '  <payment>' . PHP_EOL;
        $xml .= '    <type>test</type>' . PHP_EOL;
        $xml .= '  </payment>' . PHP_EOL;
        
        $xml .= '</request>' . PHP_EOL;
        return $xml;
    }

    /**
     * Get available tours/inventory
     */
    public function searchInventory(array $filters = []): array
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
            if (isset($filters['filter_type'])) {
                $xml .= '  <filter_type>' . htmlspecialchars($filters['filter_type']) . '</filter_type>' . PHP_EOL;
            }
            $xml .= '</request>' . PHP_EOL;

            $response = Http::timeout(30)
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

    /**
     * Get company information
     */
    public function getCompanyInfo(): array
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
            $xml .= '  <instruction>company</instruction>' . PHP_EOL;
            $xml .= '</request>' . PHP_EOL;

            $response = Http::timeout(30)
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

    /**
     * Parse XML response from Rezgo API
     */
    private function parseXmlResponse(string $xmlBody): array|string
    {
        try {
            $xml = simplexml_load_string($xmlBody);
            if ($xml === false) {
                return ['error' => 'Invalid XML response'];
            }
            return $this->xmlToArray($xml);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Convert SimpleXML to nested array with CDATA support
     */
    private function xmlToArray($xml): array|string
    {
        if (is_string($xml)) {
            return $xml;
        }

        $array = [];

        // Check if this node has text content (handles CDATA)
        $text = (string)$xml;
        if (!empty($text) && !trim($xml->asXML(), "<>")) {
            return $text;
        }

        // Process child elements
        foreach ($xml->children() as $name => $child) {
            $value = $this->xmlToArray($child);

            if (isset($array[$name])) {
                // If key already exists, convert to array
                if (!is_array($array[$name]) || !isset($array[$name][0])) {
                    $array[$name] = [$array[$name]];
                }
                $array[$name][] = $value;
            } else {
                $array[$name] = $value;
            }
        }

        // Handle attributes
        if ($xml->attributes()) {
            foreach ($xml->attributes() as $name => $value) {
                $array['@' . $name] = (string)$value;
            }
        }

        return $array ?: '';
    }
}

