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
     * Rezgo API uses query parameter format:
     * https://api.rezgo.com/json?transcode=CID&key=API_KEY&i=INSTRUCTION
     */
    private function submitOrderToRezgo($order): void
    {
        // Build query parameters for Rezgo API (using correct parameter names)
        $queryParams = [
            'transcode' => self::REZGO_CID,      // Rezgo uses "transcode" for CID
            'key' => self::REZGO_API_KEY,        // Rezgo uses "key" for API key
            'i' => 'commit',                      // Instruction: commit a booking
            'order_id' => (string)$order->id,
            'customer_name' => $order->user?->name ?? ($order->address?->name ?? 'Guest'),
            'customer_email' => $order->user?->email ?? ($order->address?->email ?? 'noemail@farmart.test'),
            'customer_phone' => $order->address?->phone ?? '000-000-0000',
            'total_amount' => (float)$order->amount,
            'currency' => 'USD',
        ];

        // Add order items as JSON parameter
        $items = [];
        if ($order->items && $order->items->count() > 0) {
            foreach ($order->items as $item) {
                $items[] = [
                    'product_id' => $item->product_id,
                    'product_name' => $item->product_name,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                    'total' => $item->amount,
                ];
            }
        }
        
        if (!empty($items)) {
            $queryParams['items'] = json_encode($items);
        }

        // Build URL with query parameters
        $url = 'https://api.rezgo.com/json?' . http_build_query($queryParams);

        // Send GET request to Rezgo API (Rezgo uses query parameters, not POST body)
        $response = Http::timeout(15)
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->get($url);

        $rezgoBookingId = $response->json('booking_id') ?? $response->json('id') ?? null;
        $isSuccessful = $response->successful();

        // Log to database for tracking (exclude API key from logs for security)
        $safeQueryParams = $queryParams;
        unset($safeQueryParams['key']); // Remove API key before logging
        
        RezgoSubmission::create([
            'order_id' => $order->id,
            'rezgo_booking_id' => $rezgoBookingId,
            'status' => $isSuccessful ? 'success' : 'failed',
            'request_payload' => json_encode($safeQueryParams, JSON_PRETTY_PRINT),
            'response_payload' => $response->body(),
            'http_status' => $response->status(),
            'error_message' => $isSuccessful ? null : $response->body(),
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
