<?php

namespace App\Listeners;

use Botble\Ecommerce\Events\OrderPlacedEvent;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SubmitOrderToRezgo
{
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
        
        Log::info('=== REZGO LISTENER TRIGGERED ===', ['order_id' => $order->id]);
        Log::info('📦 Order placed event received', [
            'order_id' => $order->id,
            'customer_email' => $order->email,
            'amount' => $order->amount,
            'items_count' => $order->items ? $order->items->count() : 0,
            'status' => $order->status,
        ]);

        try {
            Log::info('🚀 Starting Rezgo submission...');
            $this->submitOrderToRezgo($order);
            Log::info('✅ Rezgo submission completed successfully');
        } catch (\Exception $e) {
            Log::error('❌ Exception in Rezgo listener', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Submit order to Rezgo booking API
     */
    private function submitOrderToRezgo($order): void
    {
        Log::info('Building Rezgo payload...', ['order_id' => $order->id]);

        // Build payload for Rezgo API
        $payload = [
            'cid' => self::REZGO_CID,
            'api_key' => self::REZGO_API_KEY,
            'action' => 'booking_add',
            'order_id' => (string)$order->id,
            'customer_name' => $order->user?->name ?? ($order->address->name ?? 'Guest'),
            'customer_email' => $order->email ?? 'noemail@farmart.test',
            'customer_phone' => $order->phone ?? '000-000-0000',
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

        Log::info('📤 Sending to Rezgo API', [
            'url' => 'https://api.rezgo.com/v2.1/packages',
            'cid' => self::REZGO_CID,
            'payload_keys' => array_keys($payload)
        ]);

        // Send to Rezgo - using correct endpoint format per Rezgo API docs
        // Rezgo API expects query params rather than JSON body for some endpoints
        $response = Http::timeout(15)->asForm()->post('https://api.rezgo.com/v2.1/packages', [
            'cid' => self::REZGO_CID,
            'api_key' => self::REZGO_API_KEY,
            'action' => 'booking_add',
            'order_id' => (string)$order->id,
            'customer_name' => $order->user?->name ?? 'Guest',
            'customer_email' => $order->user?->email ?? ($order->address?->email ?? 'noemail@farmart.test'),
            'customer_phone' => $order->address?->phone ?? '000-000-0000',
            'total_amount' => (float)$order->amount,
            'currency' => 'USD',
            'items' => json_encode($payload['items']),
        ]);

        $rezgoBookingId = $response->json('booking_id') ?? $response->json('id') ?? null;
        $isSuccessful = $response->successful();

        Log::info('📡 Rezgo API response received', [
            'status' => $response->status(),
            'successful' => $isSuccessful,
            'booking_id' => $rezgoBookingId,
            'body' => $response->body(),
        ]);

        // Log to database for tracking
        try {
            DB::table('rezgo_submissions')->insert([
                'order_id' => $order->id,
                'rezgo_booking_id' => $rezgoBookingId,
                'status' => $isSuccessful ? 'success' : 'failed',
                'request_payload' => json_encode($payload, JSON_PRETTY_PRINT),
                'response_payload' => $response->body(),
                'http_status' => $response->status(),
                'error_message' => $isSuccessful ? null : $response->body(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Log::info('✅ Rezgo submission logged to database', ['order_id' => $order->id]);
        } catch (\Exception $dbError) {
            Log::error('❌ Failed to insert into rezgo_submissions table', [
                'order_id' => $order->id,
                'error' => $dbError->getMessage(),
            ]);
            throw $dbError;
        }

        if ($response->successful()) {
            $order->update([
                'meta' => array_merge(
                    (array) json_decode($order->meta ?? '{}', true),
                    ['rezgo_booking_id' => $rezgoBookingId]
                ),
            ]);

            Log::info('✅ Order successfully submitted to Rezgo', [
                'order_id' => $order->id,
                'rezgo_booking_id' => $rezgoBookingId,
            ]);
        } else {
            Log::error('⚠️ Rezgo API returned non-success status', [
                'order_id' => $order->id,
                'status' => $response->status(),
                'response' => $response->body(),
            ]);
        }
    }
}
