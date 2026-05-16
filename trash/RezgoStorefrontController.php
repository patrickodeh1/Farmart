<?php

namespace Botble\RezgoConnector\Http\Controllers;

use Botble\RezgoConnector\Services\RezgoApiService;
use Botble\RezgoConnector\Services\RezgoSettingsService;
use Botble\RezgoConnector\Models\RezgoOrder;
use Botble\Theme\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RezgoStorefrontController extends Controller
{
    protected RezgoApiService $api;
    protected RezgoSettingsService $settings;

    public function __construct(RezgoApiService $api, RezgoSettingsService $settings)
    {
        $this->api      = $api;
        $this->settings = $settings;
    }

    // Tour listing page
    public function index(Request $request)
    {
        $response = $this->api->searchInventory();
        $tours    = [];

        if ($response['success'] && isset($response['data']['item'])) {
            $items = $response['data']['item'];
            if (!is_array($items) || !isset($items[0])) {
                $items = [$items];
            }
            foreach ($items as $item) {
                $tours[] = [
                    'uid'       => $item['uid']      ?? '',
                    'title'     => $item['item']     ?? $item['name'] ?? 'Unknown',
                    'starting'  => (float)($item['starting'] ?? 0) > 1 ? (float)($item['starting'] ?? 0) : 0,
                    'location'  => $item['city']     ?? '',
                    'image'     => $this->extractFirstImage($item),
                ];
            }
        }

        return Theme::scope(
            'rezgo.tours',
            compact('tours'),
            'rezgo::themes.tours'
        )->render();
    }

    // Single tour page
    public function show(string $uid)
    {
        $response = $this->api->getItemFull($uid);

        if (!$response['success']) {
            abort(404);
        }

        $item  = $response['data'];
        $tour  = [
            'uid'         => $uid,
            'title'       => $item['item']    ?? $item['name'] ?? 'Unknown',
            'description' => $this->api->extractDescription($item),
            'starting'    => (float)($item['starting'] ?? 0),
            'location'    => ($item['location_name'] ?? '') . ' ' . ($item['city'] ?? ''),
            'images'      => $this->api->extractPhotoUrls($item),
            'currency'    => $item['currency_symbol'] ?? 'US $',
            'start_date'  => (int)($item['start_date'] ?? 0),
        ];

        return Theme::scope(
            'rezgo.tour',
            compact('tour'),
            'rezgo::themes.tour'
        )->render();
    }

    // Add to cart (session based)
    public function addToCart(Request $request)
    {
        $request->validate([
            'uid'        => 'required|string',
            'title'      => 'required|string',
            'date'       => 'required|date',
            'qty_adult'  => 'required|integer|min:0',
            'qty_child'  => 'required|integer|min:0',
            'price_adult'=> 'required|numeric|min:0',
            'price_child'=> 'required|numeric|min:0',
        ]);

        $qtyAdult  = (int)$request->qty_adult;
        $qtyChild  = (int)$request->qty_child;

        if ($qtyAdult + $qtyChild < 1) {
            return back()->with('error', 'Please select at least 1 ticket.');
        }

        $total = ($qtyAdult * (float)$request->price_adult)
               + ($qtyChild * (float)$request->price_child);

        $cartItem = [
            'uid'         => $request->uid,
            'title'       => $request->title,
            'date'        => $request->date,
            'qty_adult'   => $qtyAdult,
            'qty_child'   => $qtyChild,
            'price_adult' => (float)$request->price_adult,
            'price_child' => (float)$request->price_child,
            'total'       => $total,
            'image'       => $request->image ?? '',
        ];

        $cart   = Session::get('rezgo_cart', []);
        $cart[] = $cartItem;
        Session::put('rezgo_cart', $cart);

        return redirect()->route('rezgo.storefront.cart')
            ->with('success', 'Ticket added to cart!');
    }

    // Cart page
    public function cart()
    {
        $cart      = Session::get('rezgo_cart', []);
        $cartTotal = array_sum(array_column($cart, 'total'));

        return Theme::scope(
            'rezgo.cart',
            compact('cart', 'cartTotal'),
            'rezgo::themes.cart'
        )->render();
    }

    // Remove from cart
    public function removeFromCart(Request $request)
    {
        $index = (int)$request->index;
        $cart  = Session::get('rezgo_cart', []);

        if (isset($cart[$index])) {
            array_splice($cart, $index, 1);
            Session::put('rezgo_cart', $cart);
        }

        return back()->with('success', 'Item removed.');
    }

    // Checkout page
    public function checkout()
    {
        $cart = Session::get('rezgo_cart', []);

        if (empty($cart)) {
            return redirect()->route('rezgo.storefront.tours')
                ->with('error', 'Your cart is empty.');
        }

        $cartTotal = array_sum(array_column($cart, 'total'));
        $customer  = null;

        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();
        }

        return Theme::scope(
            'rezgo.checkout',
            compact('cart', 'cartTotal', 'customer'),
            'rezgo::themes.checkout'
        )->render();
    }

    // Process checkout
    public function processCheckout(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email',
            'phone'      => 'nullable|string|max:30',
        ]);

        $cart = Session::get('rezgo_cart', []);

        if (empty($cart)) {
            return redirect()->route('rezgo.storefront.tours')
                ->with('error', 'Your cart is empty.');
        }

        $customerId = Auth::guard('customer')->check()
            ? Auth::guard('customer')->id()
            : null;

        $orders = [];

        foreach ($cart as $item) {
            // Create order record
            $order = RezgoOrder::create([
                'customer_id'  => $customerId,
                'rezgo_uid'    => $item['uid'],
                'rezgo_title'  => $item['title'],
                'tour_date'    => $item['date'],
                'price_adult'  => $item['price_adult'],
                'price_child'  => $item['price_child'],
                'qty_adult'    => $item['qty_adult'],
                'qty_child'    => $item['qty_child'],
                'total'        => $item['total'],
                'first_name'   => $request->first_name,
                'last_name'    => $request->last_name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'status'       => 'pending',
            ]);

            // Auto-submit to Rezgo
            $bookingData = [
                'order_id'           => $order->id,
                'book'               => $item['uid'],
                'date'               => $item['date'],
                'adult_num'          => $item['qty_adult'],
                'child_num'          => $item['qty_child'],
                'senior_num'         => 0,
                'tour_first_name'    => $request->first_name,
                'tour_last_name'     => $request->last_name,
                'tour_email_address' => $request->email,
                'tour_phone_number'  => $request->phone ?? '000-0000',
                'tour_address_1'     => '123 Main St',
                'tour_city'          => 'Orlando',
                'tour_stateprov'     => 'FL',
                'tour_country'       => 'US',
                'tour_postal_code'   => '32801',
                'payment_method'     => 'Cash',
            ];

            $result = $this->api->commitBooking($bookingData);

            if ($result['success']) {
                $order->update([
                    'status'           => 'confirmed',
                    'rezgo_booking_id' => $result['trans_num'] ?? null,
                ]);
            } else {
                $order->update(['status' => 'failed']);
            }

            $orders[] = $order->fresh();
        }

        // Clear cart
        Session::forget('rezgo_cart');

        $firstOrder = $orders[0];

        return redirect()->route('rezgo.storefront.confirmation', $firstOrder->id);
    }

    // Confirmation page
    public function confirmation(int $id)
    {
        $order = RezgoOrder::findOrFail($id);

        return Theme::scope(
            'rezgo.confirmation',
            compact('order'),
            'rezgo::themes.confirmation'
        )->render();
    }

    // Helper: extract first image from item data
    private function extractFirstImage(array $item): string
    {
        $urls = $this->api->extractPhotoUrls($item);
        return $urls[0] ?? '';
    }
}
