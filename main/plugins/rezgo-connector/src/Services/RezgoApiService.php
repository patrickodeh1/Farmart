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
            // Build XML request payload
            $orderId = $bookingData['order_id'] ?? null;
            
            $xmlPayload = $this->buildCommitXmlPayload($bookingData);

            // Log request (without sensitive data)
            $logData = $bookingData;
            unset($logData['key']);
            RezgoLog::sync('commit_booking', $orderId, 'Submitting booking via POST XML', $logData);

            // Send POST request with XML
            $response = Http::timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/xml',
                    'Accept' => 'application/json',
                ])
                ->post($this->baseUrl, $xmlPayload);

            $responseData = $response->json();

            // Check if booking was successful
            if ($response->successful() && isset($responseData['status']) && $responseData['status'] == 1) {
                $transNum = $responseData['trans_num'] ?? $responseData['booking_id'] ?? null;
                
                RezgoLog::sync(
                    'commit_booking',
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
            return ['success' => false, 'error' => $error, 'status' => 0];
        }

        try {
            $orderId = $bookingData['order_id'] ?? null;
            $xmlPayload = $this->buildCommitXmlPayload($bookingData);

            $logData = $bookingData;
            unset($logData['key']);
            RezgoLog::sync('commit_booking', $orderId, 'Submitting booking via POST XML', $logData);

            $response = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/xml', 'Accept' => 'application/json'])
                ->post($this->baseUrl, $xmlPayload);

            $responseData = $response->json();

            if ($response->successful() && isset($responseData['status']) && $responseData['status'] == 1) {
                $transNum = $responseData['trans_num'] ?? $responseData['booking_id'] ?? null;
                RezgoLog::sync('commit_booking', $orderId, 'Booking successful - Transaction #' . $transNum, ['trans_num' => $transNum]);
                return ['success' => true, 'status' => 200, 'data' => $responseData, 'trans_num' => $transNum, 'message' => 'Booking complete'];
            }

            $error = $responseData['error'] ?? $responseData['message'] ?? 'Unknown error from Rezgo';
            $errorCode = $responseData['error_code'] ?? 'N/A';
            RezgoLog::error('commit_booking', $orderId, "Booking failed [$errorCode]: " . $error, $responseData);
            return ['success' => false, 'status' => $response->status(), 'error' => $error, 'error_code' => $errorCode, 'data' => $responseData];

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
        $firstName = $bookingData['tour_first_name'] ?? 'Customer';
        $lastName = $bookingData['tour_last_name'] ?? 'Test';
        $address = $bookingData['tour_address_1'] ?? '123 Main St';
        $city = $bookingData['tour_city'] ?? 'Orlando';
        $state = $bookingData['tour_stateprov'] ?? 'FL';
        $country = $bookingData['tour_country'] ?? 'US';
        $postalCode = $bookingData['tour_postal_code'] ?? '12345';
        $phone = $bookingData['tour_phone_number'] ?? '555-1234';
        $email = $bookingData['tour_email_address'] ?? 'test@example.com';
        $paymentMethod = $bookingData['payment_method'] ?? 'Credit Cards';
        $cardToken = $bookingData['tour_card_token'] ?? '';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<request>' . PHP_EOL;
        $xml .= '  <transcode>' . htmlspecialchars($cid) . '</transcode>' . PHP_EOL;
        $xml .= '  <key>' . htmlspecialchars($apiKey) . '</key>' . PHP_EOL;
        $xml .= '  <instruction>commit</instruction>' . PHP_EOL;
        $xml .= '  <cart>' . PHP_EOL;
        $xml .= '    <item>' . PHP_EOL;
        $xml .= '      <uid>' . htmlspecialchars($bookingData['book']) . '</uid>' . PHP_EOL;
        $xml .= '      <date>' . htmlspecialchars($bookingData['date']) . '</date>' . PHP_EOL;
        $xml .= '      <num_adults>' . ((int)($bookingData['adult_num'] ?? 1)) . '</num_adults>' . PHP_EOL;
        $xml .= '      <num_children>' . ((int)($bookingData['child_num'] ?? 0)) . '</num_children>' . PHP_EOL;
        $xml .= '      <num_seniors>' . ((int)($bookingData['senior_num'] ?? 0)) . '</num_seniors>' . PHP_EOL;
        $xml .= '    </item>' . PHP_EOL;
        $xml .= '  </cart>' . PHP_EOL;
        $xml .= '  <payment>' . PHP_EOL;
        $xml .= '    <tour_first_name>' . htmlspecialchars($firstName) . '</tour_first_name>' . PHP_EOL;
        $xml .= '    <tour_last_name>' . htmlspecialchars($lastName) . '</tour_last_name>' . PHP_EOL;
        $xml .= '    <tour_address_1>' . htmlspecialchars($address) . '</tour_address_1>' . PHP_EOL;
        $xml .= '    <tour_city>' . htmlspecialchars($city) . '</tour_city>' . PHP_EOL;
        $xml .= '    <tour_stateprov>' . htmlspecialchars($state) . '</tour_stateprov>' . PHP_EOL;
        $xml .= '    <tour_country>' . htmlspecialchars($country) . '</tour_country>' . PHP_EOL;
        $xml .= '    <tour_postal_code>' . htmlspecialchars($postalCode) . '</tour_postal_code>' . PHP_EOL;
        $xml .= '    <tour_phone_number>' . htmlspecialchars($phone) . '</tour_phone_number>' . PHP_EOL;
        $xml .= '    <tour_email_address>' . htmlspecialchars($email) . '</tour_email_address>' . PHP_EOL;
        $xml .= '    <payment_method>' . htmlspecialchars($paymentMethod) . '</payment_method>' . PHP_EOL;
        if ($cardToken) {
            $xml .= '    <tour_card_token>' . htmlspecialchars($cardToken) . '</tour_card_token>' . PHP_EOL;
        }
        $xml .= '    <agree_terms>1</agree_terms>' . PHP_EOL;
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
                ->withHeaders(['Content-Type' => 'application/xml', 'Accept' => 'application/json'])
                ->post($this->baseUrl, $xml);

            return ['success' => $response->successful(), 'data' => $response->json()];
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
                ->withHeaders(['Content-Type' => 'application/xml', 'Accept' => 'application/json'])
                ->post($this->baseUrl, $xml);

            return ['success' => $response->successful(), 'data' => $response->json()];
        } catch (\Exception $e) {
            RezgoLog::error('get_company', null, 'Failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}

