#!/usr/bin/env php
<?php

/**
 * Standalone Rezgo Test Data Setup Script
 * 
 * Usage: php setup_rezgo_test_data.php
 * 
 * This script sets up test data WITHOUT requiring the Rezgo plugin to be installed.
 * It will:
 * 1. Update existing John Doe submission to Dreamzone Test
 * 2. Create 10 Farmart products (5 Universal + 5 Disney)
 * 3. Create 10 test orders with Dreamzone Test customer
 */

// Bootstrap Laravel
$basePath = __DIR__ . '/main';
require_once $basePath . '/vendor/autoload.php';
$app = require_once $basePath . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Botble\Ecommerce\Models\Customer;
use Botble\Ecommerce\Models\Order;
use Botble\Ecommerce\Models\OrderProduct;
use Botble\Ecommerce\Models\Product;
use Illuminate\Support\Str;

echo "\n";
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║         REZGO TEST DATA SETUP - Standalone Script          ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";

// Check if we have DB connection
try {
    \DB::connection()->getPdo();
    echo "✓ Database connection successful\n\n";
} catch (\Exception $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "\n";
    exit(1);
}

// Step 1: Update John Doe submission
echo "STEP 1: Updating first submission to 'Dreamzone Test'\n";
echo "─────────────────────────────────────────────────────────────\n";

try {
    // Check if rezgo_submissions table exists
    $tableExists = \DB::connection()->getSchemaBuilder()->hasTable('rezgo_submissions');
    
    if ($tableExists) {
        $submission = \DB::table('rezgo_submissions')
            ->where('status', 'success')
            ->first();
        
        if ($submission) {
            $request = json_decode($submission->request_payload, true);
            $request['tour_first_name'] = 'Dreamzone';
            $request['tour_last_name'] = 'Test';
            $request['customer_email'] = 'test@dreamzone.com';
            
            \DB::table('rezgo_submissions')
                ->where('id', $submission->id)
                ->update(['request_payload' => json_encode($request)]);
            
            echo "✓ Updated submission #" . $submission->id . "\n";
            echo "  Name changed to: Dreamzone Test\n";
            echo "  Email: test@dreamzone.com\n";
        } else {
            echo "ℹ No existing successful submission found\n";
        }
    } else {
        echo "ℹ rezgo_submissions table doesn't exist yet (plugin not installed)\n";
    }
} catch (\Exception $e) {
    echo "⚠ Error updating submission: " . $e->getMessage() . "\n";
}

echo "\n";

// Step 2: Create test products
echo "STEP 2: Creating 10 test products\n";
echo "─────────────────────────────────────────────────────────────\n";

// Define test tours (matching Rezgo's typical offerings)
$testTours = [
    // Universal Orlando (5)
    ['name' => 'Universal Orlando Express Pass - 1 Park', 'type' => 'universal', 'price' => 299.99],
    ['name' => 'Universal Orlando Express Pass - 2 Parks', 'type' => 'universal', 'price' => 399.99],
    ['name' => 'Universal Studios Florida 1-Day Ticket', 'type' => 'universal', 'price' => 159.99],
    ['name' => 'Islands of Adventure 1-Day Ticket', 'type' => 'universal', 'price' => 159.99],
    ['name' => 'Universal Orlando 2-Park Combo Ticket', 'type' => 'universal', 'price' => 249.99],
    
    // Disney Parks (5)
    ['name' => 'Walt Disney World Magic Kingdom 1-Day Ticket', 'type' => 'disney', 'price' => 189.99],
    ['name' => 'Walt Disney World Epcot 1-Day Ticket', 'type' => 'disney', 'price' => 189.99],
    ['name' => 'Walt Disney World Hollywood Studios 1-Day Ticket', 'type' => 'disney', 'price' => 189.99],
    ['name' => 'Walt Disney World Animal Kingdom 1-Day Ticket', 'type' => 'disney', 'price' => 189.99],
    ['name' => 'Walt Disney World 4-Park Combo Ticket', 'type' => 'disney', 'price' => 599.99],
];

$createdProducts = [];

foreach ($testTours as $idx => $tour) {
    try {
        // Check if product exists
        $product = Product::where('name', $tour['name'])->first();
        
        if (!$product) {
            $product = new Product();
            $product->name = $tour['name'];
            $product->slug = Str::slug($tour['name']);
            $product->description = 'Test product for ' . $tour['type'] . ' experience';
            $product->status = 'published';
            $product->price = $tour['price'];
            $product->quantity = 100;
            $product->save();
            
            echo "✓ Created: " . $tour['name'] . " (ID: " . $product->id . ")\n";
        } else {
            echo "✓ Found existing: " . $tour['name'] . " (ID: " . $product->id . ")\n";
        }
        
        $createdProducts[] = $product;
        
    } catch (\Exception $e) {
        echo "✗ Error creating product '" . $tour['name'] . "': " . $e->getMessage() . "\n";
    }
}

echo "\n";

// Step 3: Create test customer
echo "STEP 3: Creating test customer 'Dreamzone Test'\n";
echo "─────────────────────────────────────────────────────────────\n";

try {
    $customer = Customer::firstOrCreate(
        ['email' => 'test@dreamzone.com'],
        [
            'first_name' => 'Dreamzone',
            'last_name' => 'Test',
            'phone' => '555-0123',
            'password' => bcrypt('password123'),
            'is_active' => true,
        ]
    );
    
    if ($customer->wasRecentlyCreated) {
        echo "✓ Created new customer: " . $customer->first_name . " " . $customer->last_name . "\n";
    } else {
        echo "✓ Using existing customer: " . $customer->first_name . " " . $customer->last_name . "\n";
    }
    echo "  Email: " . $customer->email . "\n";
    echo "  Customer ID: " . $customer->id . "\n";
    
} catch (\Exception $e) {
    echo "✗ Error creating customer: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n";

// Step 4: Create test orders
echo "STEP 4: Creating 10 test orders\n";
echo "─────────────────────────────────────────────────────────────\n";

$createdOrders = [];
$now = now();

foreach ($createdProducts as $idx => $product) {
    try {
        $order = new Order();
        $order->user_id = $customer->id;
        $order->code = 'REZTEST' . date('YmdHis') . str_pad($idx + 1, 2, '0', STR_PAD_LEFT);
        $order->description = 'Rezgo Test Order - ' . $product->name;
        $order->status = 'pending';
        $order->payment_status = 'pending';
        $order->total = $product->price;
        $order->subtotal = $product->price;
        $order->save();
        
        // Create order product line item
        $orderProduct = new OrderProduct();
        $orderProduct->order_id = $order->id;
        $orderProduct->product_id = $product->id;
        $orderProduct->product_name = $product->name;
        $orderProduct->product_price = $product->price;
        $orderProduct->qty = 1;
        $orderProduct->price = $product->price;
        $orderProduct->save();
        
        echo "✓ Order #" . $order->id . " | Code: " . $order->code . "\n";
        echo "  Product: " . $product->name . "\n";
        echo "  Price: $" . number_format($product->price, 2) . "\n";
        
        $createdOrders[] = $order;
        
    } catch (\Exception $e) {
        echo "✗ Error creating order for '" . $product->name . "': " . $e->getMessage() . "\n";
    }
}

echo "\n";

// Summary
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║                    SETUP COMPLETE ✓                        ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";

echo "SUMMARY:\n";
echo "────────────────────────────────────────────────────────────\n";
echo "✓ Customer Created: Dreamzone Test (test@dreamzone.com)\n";
echo "✓ Products Created: " . count($createdProducts) . " test products\n";
echo "  - 5 Universal Orlando products\n";
echo "  - 5 Disney Parks products\n";
echo "✓ Orders Created: " . count($createdOrders) . " test orders\n";
echo "\n";

echo "NEXT STEPS:\n";
echo "────────────────────────────────────────────────────────────\n";
echo "1. Review the test data in Farmart admin:\n";
echo "   - Products: Admin > Products\n";
echo "   - Orders: Admin > Orders\n";
echo "   - Customer: Admin > Customers > test@dreamzone.com\n";
echo "\n";
echo "2. When ready to submit to Rezgo:\n";
echo "   - Install the Rezgo plugin\n";
echo "   - Configure API credentials in Rezgo Connector settings\n";
echo "   - Trigger order events to submit to Rezgo API\n";
echo "\n";
echo "3. Verify in Rezgo backend:\n";
echo "   - Login to https://admin.rezgo.com\n";
echo "   - Look for 10 bookings from 'Dreamzone Test'\n";
echo "\n";

echo "TEST DATA READY FOR PLUGIN INTEGRATION ✓\n";
echo "\n";
