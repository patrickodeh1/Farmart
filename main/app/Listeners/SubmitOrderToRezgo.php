<?php

namespace App\Listeners;

use Botble\Ecommerce\Events\OrderPlacedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SubmitOrderToRezgo implements ShouldQueue
{
    use InteractsWithQueue;

    private const REZGO_API_URL = 'https://api.rezgo.com/v1';
    private const REZGO_CID = '32036';
    private const REZGO_API_KEY = '9B8-D1V1-V2C8-H4O5-O7Q';

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPlacedEvent $event): void
    {
        $order = $event->order;
        
        Log::info('Order placed event received', [
            'order_id' => $order->id,
            'customer_email' => $order->email,
            'total' => $order->total,
            'items' => $order->items ? $order->items->count() : 0,
        ]);

        try {
            $this->submitOrderToRezgo($order);
        } catch (\Exception $e) {
            Log::error('Failed to submit order to Rezgo', [
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
            'order_id' => $order->id,
            'customer_name' => $order->user?->name ?? $order->address->name ?? 'Guest',
            'customer_email' => $order->email,
            'customer_phone' => $order->phone ?? '',
            'total_amount' => $order->total,
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

        // Send to Rezgo
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-Api-Key' => self::REZGO_API_KEY,
        ])->post(self::REZGO_API_URL . '/bookings', $payload);

        Log::info('Rezgo API response', [
            'order_id' => $order->id,
            'status' => $response->status(),
            'response' => $response->json(),
        ]);

        if ($response->successful()) {
            $order->update([
                'meta' => array_merge(
                    (array) json_decode($order->meta ?? '{}', true),
                    ['rezgo_booking_id' => $response->json('booking_id') ?? null]
                ),
            ]);

            Log::info('Order successfully submitted to Rezgo', [
                'order_id' => $order->id,
                'rezgo_response' => $response->json(),
            ]);
        } else {
            throw new \Exception('Rezgo API error: ' . $response->body());
        }
    }
}
