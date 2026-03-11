<?php

namespace App\Listeners;

use App\Models\RezgoSubmission;
use Botble\Ecommerce\Events\OrderPlacedEvent;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SubmitOrderToRezgo
{
    private const REZGO_CID = '32036';
    private const REZGO_API_KEY = '9B8-D1V1-V2C8-H4O5-O7Q';
    
    // Configuration: Which Rezgo tour to book for Farmart orders
    // Replace with the actual tour UID from your Rezgo account
    // Available UIDs: 418065 (1-Day), 418066 (2-Day), etc.
    private const REZGO_TOUR_UID = '418065';
    
    // Configuration: Booking date offset (days from today)
    // Set to 0 for today, 1 for tomorrow, etc.
    private const BOOKING_DATE_OFFSET = 1;
    
    // Configuration: How to handle passenger counts
    // Set all Farmart quantities as "adult" passengers
    private const PASSENGER_TYPE = 'adult';

    /**
     * Handle the event.
     */
    public function handle(OrderPlacedEvent $event): void
    {
        $order = $event->order;

        try {
            $this->submitOrderToRezgo($order);
        } catch (\Exception $e) {
            Log::error('Rezgo submission failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Submit order to Rezgo booking API
     * 
     * Rezgo API "commit" instruction creates a booking with proper passenger and billing info.
     * Format: https://api.rezgo.com/index_json.php?transcode=CID&key=API_KEY&i=commit&[booking_params]
     */
    private function submitOrderToRezgo($order): void
    {
        // Extract billing information from order
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
        
        // Calculate total passengers from order items
        $totalPassengers = 0;
        if ($order->items && $order->items->count() > 0) {
            foreach ($order->items as $item) {
                $totalPassengers += (int)$item->qty;
            }
        }
        
        // Fallback if no passengers calculated
        if ($totalPassengers <= 0) {
            $totalPassengers = 1;
        }
        
        // Determine passenger count based on configuration
        $passengerParams = [];
        switch (self::PASSENGER_TYPE) {
            case 'adult':
                $passengerParams['adult_num'] = $totalPassengers;
                break;
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
        $bookingDate = date('Y-m-d', strtotime("+". self::BOOKING_DATE_OFFSET . " days"));
        
        // Build commit request parameters
        $queryParams = [
            'transcode' => self::REZGO_CID,
            'key' => self::REZGO_API_KEY,
            'i' => 'commit',
            'book' => self::REZGO_TOUR_UID,              // Required: Tour UID to book
            'date' => $bookingDate,                      // Required: Booking date
            'agree_terms' => '1',                        // Required: User agreement
            'payment_method' => 'credit_card',           // Default payment method
            'tour_first_name' => $firstName,             // Billing: First name
            'tour_last_name' => $lastName,               // Billing: Last name
            'tour_address_1' => $addressLine1,           // Billing: Address
            'tour_city' => $city,                        // Billing: City
            'tour_stateprov' => $state,                  // Billing: State
            'tour_country' => $country,                  // Billing: Country
            'tour_postal_code' => $zipCode,              // Billing: Zip
            'tour_phone_number' => $phone,               // Billing: Phone
            'tour_email_address' => $email,              // Billing: Email
        ];
        
        // Add passenger count parameters
        $queryParams = array_merge($queryParams, $passengerParams);
        
        // Build URL with all parameters
        $url = 'https://api.rezgo.com/index_json.php?' . http_build_query($queryParams);

        // Send GET request to Rezgo API
        $response = Http::timeout(15)
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->get($url);

        $rezgoBookingId = $response->json('trans_num') ?? $response->json('booking_id') ?? null;
        $isSuccessful = $response->successful() && ($response->json('status') == 1);

        // Log to database (exclude sensitive data like billing info and API key)
        $safeQueryParams = $queryParams;
        unset(
            $safeQueryParams['key'],                    // API Key
            $safeQueryParams['tour_email_address'],     // Email
            $safeQueryParams['tour_phone_number'],      // Phone
            $safeQueryParams['tour_address_1'],         // Address
            $safeQueryParams['tour_postal_code']        // Zip code
        );
        
        RezgoSubmission::create([
            'order_id' => $order->id,
            'rezgo_booking_id' => $rezgoBookingId,
            'status' => $isSuccessful ? 'success' : 'failed',
            'request_payload' => json_encode($safeQueryParams, JSON_PRETTY_PRINT),
            'response_payload' => $response->body(),
            'http_status' => $response->status(),
            'error_message' => $isSuccessful ? null : $response->json('error') ?? $response->body(),
        ]);

        if ($response->successful()) {
            $order->update([
                'meta' => array_merge(
                    (array) json_decode($order->meta ?? '{}', true),
                    ['rezgo_booking_id' => $rezgoBookingId]
                ),
            ]);

            Log::info('Order submitted to Rezgo', [
                'order_id' => $order->id,
                'rezgo_booking_id' => $rezgoBookingId,
            ]);
        }
    }
}
