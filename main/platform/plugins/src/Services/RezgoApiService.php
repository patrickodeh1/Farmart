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

    /**
     * Build XML payload for booking commit.
     *
     * FIXED STRUCTURE:
     * - <booking> block uses <book> for tour UID (NOT <cart><item><uid>)
     * - <payment> block uses tour_* prefixed field names (NOT <customer>)
     * - payment_method is "Cash" for test/manual (NOT <type>test</type>)
     */
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
     * Get available tours/inventory
     */
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

    /**
     * Get company information
     */
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

        foreach ($xml->children() as $name => $child) {
            $value = trim((string)$child) ?: $this->xmlToArray($child);
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
}

