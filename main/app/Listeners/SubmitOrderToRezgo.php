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
     */
    private function submitOrderToRezgo($order): void
    {
        // Build payload for Rezgo API
        $payload = [
            'cid' => self::REZGO_CID,
            'api_key' => self::REZGO_API_KEY,
            'action' => 'booking_add',
            'order_id' => (string)$order->id,
            'customer_name' => $order->user?->name ?? ($order->address?->name ?? 'Guest'),
            'customer_email' => $order->user?->email ?? ($order->address?->email ?? 'noemail@farmart.test'),
            'customer_phone' => $order->address?->phone ?? '000-000-0000',
            'total_amount' => (float)$order->amount,
            'currency' => 'USD',
            'items' => [],
        ];

        // Add order items/products
        if ($order->items && $order->items->count() > 0) {
            foreach ($order->items as $item) {
                $payload['items'][] = [
                    'product_id' => $item->product_id,
                    'product_name' => $item->product_name,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                    'total' => $item->amount,
                ];
            }
        }

        // Send to Rezgo API with proper authentication
        // Remove CID and API key from payload - add as headers instead
        $payloadForAPI = $payload;
        unset($payloadForAPI['cid'], $payloadForAPI['api_key']);
        
        $response = Http::timeout(15)
            ->withHeaders([
                'X-Rezgo-CID' => self::REZGO_CID,
                'X-Rezgo-Key' => self::REZGO_API_KEY,
            ])
            ->post('https://api.rezgo.com/v2.1/bookings', $payloadForAPI);

        $rezgoBookingId = $response->json('booking_id') ?? $response->json('id') ?? null;
        $isSuccessful = $response->successful();

        // Log to database for tracking
        RezgoSubmission::create([
            'order_id' => $order->id,
            'rezgo_booking_id' => $rezgoBookingId,
            'status' => $isSuccessful ? 'success' : 'failed',
            'request_payload' => json_encode($payloadForAPI, JSON_PRETTY_PRINT),
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
