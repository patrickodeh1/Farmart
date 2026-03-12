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
        $this->api = $api;
    }

    /**
     * Handle the OrderPlacedEvent
     */
    public function handle(OrderPlacedEvent $event): void
    {
        $order = $event->order;

        // Check if sync is enabled
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
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Submit order to Rezgo API
     */
    private function submitOrderToRezgo($order): void
    {
        // Get product mapping
        if ($order->items && $order->items->count() > 0) {
            $firstItem = $order->items->first();
            $mapping = RezgoProductMapping::getByProductId($firstItem->product_id);

            if (!$mapping || !$mapping->rezgo_uid) {
                RezgoLog::warning(
                    'submit_order',
                    $order->id,
                    'No Rezgo mapping found for product',
                    ['product_id' => $firstItem->product_id]
                );
                $rezgoUid = null;
            } else {
                $rezgoUid = $mapping->rezgo_uid;
            }
        } else {
            $rezgoUid = null;
        }

        // Extract billing information
        $address = $order->address;
        $customer = $order->user;

        $firstName = $customer?->first_name ?? ($address?->first_name ?? 'John');
        $lastName = $customer?->last_name ?? ($address?->last_name ?? 'Doe');
        $email = $customer?->email ?? ($address?->email ?? 'noemail@farmart.test');
        $phone = $address?->phone ?? '000-000-0000';
        $addressLine1 = $address?->address ?? '';
        $city = $address?->city ?? 'Unknown';
        $state = $address?->state ?? '';
        $country = $address?->country ?? 'US';
        $zipCode = $address?->zip_code ?? '';

        // Calculate total passengers
        $totalPassengers = 0;
        if ($order->items && $order->items->count() > 0) {
            foreach ($order->items as $item) {
                $totalPassengers += (int)$item->qty;
            }
        }

        if ($totalPassengers <= 0) {
            $totalPassengers = 1;
        }

        // Determine passenger type
        $passengerType = $this->settings->getDefaultPassengerType();
        $passengerParams = [];

        switch ($passengerType) {
            case 'child':
                $passengerParams['child_num'] = $totalPassengers;
                break;
            case 'senior':
                $passengerParams['senior_num'] = $totalPassengers;
                break;
            default:
                $passengerParams['adult_num'] = $totalPassengers;
        }

        // Calculate booking date
        $bookingDateOffset = $this->settings->getBookingDateOffset();
        $bookingDate = date('Y-m-d', strtotime("+{$bookingDateOffset} days"));

        // Build booking data
        $bookingData = [
            'book' => $rezgoUid,                         // Use mapped tour or null
            'date' => $bookingDate,
            'agree_terms' => '1',
            'payment_method' => 'Cash',
            'tour_first_name' => $firstName,
            'tour_last_name' => $lastName,
            'tour_address_1' => $addressLine1,
            'tour_city' => $city,
            'tour_stateprov' => $state,
            'tour_country' => $country,
            'tour_postal_code' => $zipCode,
            'tour_phone_number' => $phone,
            'tour_email_address' => $email,
            'order_id' => (string)$order->id,
        ];

        // Add passenger count
        $bookingData = array_merge($bookingData, $passengerParams);

        // Submit to Rezgo API
        $response = $this->api->commitBooking($bookingData);

        // Prepare safe request data for logging (no sensitive info)
        $safeBookingData = $bookingData;
        unset(
            $safeBookingData['tour_email_address'],
            $safeBookingData['tour_phone_number'],
            $safeBookingData['tour_address_1'],
            $safeBookingData['tour_postal_code']
        );

        // Save submission record
        RezgoSubmission::create([
            'order_id' => $order->id,
            'rezgo_booking_id' => $response['trans_num'] ?? null,
            'status' => $response['success'] ? 'success' : 'failed',
            'request_payload' => json_encode($safeBookingData, JSON_PRETTY_PRINT),
            'response_payload' => json_encode($response['data'] ?? $response, JSON_PRETTY_PRINT),
            'http_status' => $response['status'] ?? 0,
            'error_message' => !$response['success'] ? $response['error'] : null,
        ]);

        // Log result
        if ($response['success']) {
            RezgoLog::sync(
                'submit_order',
                $order->id,
                'Order submitted successfully',
                ['trans_num' => $response['trans_num']]
            );

            // Update order metadata
            $order->update([
                'meta' => array_merge(
                    (array)json_decode($order->meta ?? '{}', true),
                    ['rezgo_booking_id' => $response['trans_num']]
                ),
            ]);
        } else {
            RezgoLog::error(
                'submit_order',
                $order->id,
                'Order submission failed: ' . $response['error']
            );
        }
    }
}
