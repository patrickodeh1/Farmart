<?php

namespace Botble\RezgoConnector\Services;

use Illuminate\Support\Facades\Http;
use Botble\RezgoConnector\Models\RezgoLog;

class RezgoApiService
{
    private RezgoSettingsService $settings;
    private string $baseUrl = 'https://api.rezgo.com/index_json.php';

    public function __construct(RezgoSettingsService $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Commit a booking to Rezgo
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

        // Build request parameters
        $params = [
            'transcode' => $this->settings->getCid(),
            'key' => $this->settings->getApiKey(),
            'i' => 'commit',
        ];

        // Merge with booking data
        $params = array_merge($params, $bookingData);

        try {
            // Build URL
            $url = $this->baseUrl . '?' . http_build_query($params);

            // Log request
            $logParams = $params;
            unset($logParams['key']); // Don't log API key
            RezgoLog::sync('commit_booking', $bookingData['order_id'] ?? null, 'Submitting booking', $logParams);

            // Send request
            $response = Http::timeout(15)
                ->withHeaders(['Accept' => 'application/json'])
                ->get($url);

            $responseData = $response->json();

            // Check response
            if ($response->successful() && isset($responseData['status']) && $responseData['status'] == 1) {
                RezgoLog::sync(
                    'commit_booking',
                    $bookingData['order_id'] ?? null,
                    'Booking successful',
                    ['trans_num' => $responseData['trans_num'] ?? null]
                );

                return [
                    'success' => true,
                    'status' => 200,
                    'data' => $responseData,
                    'trans_num' => $responseData['trans_num'] ?? null,
                    'message' => $responseData['message'] ?? 'Booking complete',
                ];
            }

            // Handle failure response
            $error = $responseData['error'] ?? 'Unknown error';
            RezgoLog::error(
                'commit_booking',
                $bookingData['order_id'] ?? null,
                'Booking failed: ' . $error,
                $responseData
            );

            return [
                'success' => false,
                'status' => $response->status(),
                'error' => $error,
                'data' => $responseData,
            ];
        } catch (\Exception $e) {
            RezgoLog::error(
                'commit_booking',
                $bookingData['order_id'] ?? null,
                'API request failed: ' . $e->getMessage()
            );

            return [
                'success' => false,
                'error' => $e->getMessage(),
                'status' => 0,
            ];
        }
    }

    /**
     * Get available tours/inventory
     */
    public function searchInventory(array $filters = []): array
    {
        if (!$this->settings->isConfigured()) {
            return ['success' => false, 'error' => 'API not configured'];
        }

        $params = [
            'transcode' => $this->settings->getCid(),
            'key' => $this->settings->getApiKey(),
            'i' => 'search',
        ];

        $params = array_merge($params, $filters);

        try {
            $url = $this->baseUrl . '?' . http_build_query($params);
            
            $response = Http::timeout(15)
                ->withHeaders(['Accept' => 'application/json'])
                ->get($url);

            return [
                'success' => $response->successful(),
                'data' => $response->json(),
            ];
        } catch (\Exception $e) {
            RezgoLog::error('search_inventory', null, 'Search failed: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
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

        $params = [
            'transcode' => $this->settings->getCid(),
            'key' => $this->settings->getApiKey(),
            'i' => 'company',
        ];

        try {
            $url = $this->baseUrl . '?' . http_build_query($params);
            
            $response = Http::timeout(15)
                ->withHeaders(['Accept' => 'application/json'])
                ->get($url);

            return [
                'success' => $response->successful(),
                'data' => $response->json(),
            ];
        } catch (\Exception $e) {
            RezgoLog::error('get_company', null, 'Failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
