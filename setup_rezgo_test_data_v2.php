#!/usr/bin/env php
<?php

/**
 * Rezgo Test Data Setup with Proper Product Variety and Dates
 * 
 * Usage: php setup_rezgo_test_data_v2.php
 * 
 * Creates 10 test orders with different products on different dates
 */

$basePath = __DIR__;
if (!file_exists($basePath . '/vendor/autoload.php') && file_exists($basePath . '/main/vendor/autoload.php')) {
    $basePath = $basePath . '/main';
}

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
echo "║       REZGO TEST DATA SETUP - V2 (Proper Products)        ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";

try {
    \DB::connection()->getPdo();
    echo "✓ Database connection successful\n\n";
} catch (\Exception $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "\n";
    exit(1);
}

// Test products with proper variety and dates
$testProducts = [
    // Universal Orlando (5 products - different types, different dates)
    ['name' => 'Universal Orlando 1-Day Base Ticket', 'type' => 'universal', 'date' => '2026-03-17', 'price' => 159.99],
    ['name' => 'Universal Orlando 2-Day Base Ticket', 'type' => 'universal', 'date' => '2026-03-18', 'price' => 249.99],
    ['name' => 'Universal Orlando 3-Day Base Ticket', 'type' => 'universal', 'date' => '2026-03-19', 'price' => 319.99],
    ['name' => 'Universal Express Pass 1-Park', 'type' => 'universal', 'date' => '2026-03-20', 'price' => 299.99],
    ['name' => 'Universal Express Pass 2-Parks', 'type' => 'universal', 'date' => '2026-03-21', 'price' => 399.99],
    
    // Disney Parks (5 products - different types, different dates)
    ['name' => 'Disney 1-Day Hopper Ticket', 'type' => 'disney', 'date' => '2026-03-22', 'price' => 199.99],
    ['name' => 'Disney 1-Day Magic Kingdom Ticket', 'type' => 'disney', 'date' => '2026-03-23', 'price' => 189.99],
    ['name' => 'Disney 2-Day Base Ticket', 'type' => 'disney', 'date' => '2026-03-24', 'price' => 349.99],
    ['name' => 'Disney 3-Day Base Ticket', 'type' => 'disney', 'date' => '2026-03-25', 'price' => 449.99],
    ['name' => 'Disney 4-Day Base Ticket', 'type' => 'disney', 'date' => '2026-03-26', 'price' => 549.99],
];

echo "STEP 1: Creating 10 test products (different types & dates)\n";
echo "─────────────────────────────────────────────────────────────\n";

$createdProducts = [];

foreach ($testProducts as $product) {
    try {
        $existing = Product::where('name', $product['name'])->first();
        
        if (!$existing) {
            $newProduct = new Product();
            $newProduct->name = $product['name'];
            $newProduct->description = 'Test product for ' . $product['type'] . ' experience - ' . $product['date'];
            $newProduct->status = 'published';
            $newProduct->price = $product['price'];
            $newProduct->quantity = 100;
            $newProduct->save();
            
            echo "✓ Created: {$product['name']} (Date: {$product['date']}, Price: \${$product['price']})\n";
            echo "  ID: {$newProduct->id}\n";
        } else {
            echo "✓ Found existing: {$product['name']} (ID: {$existing->id})\n";
            $newProduct = $existing;
        }
        
        $createdProducts[] = [
            'product' => $newProduct,
            'date' => $product['date'],
            'price' => $product['price'],
        ];
        
    } catch (\Exception $e) {
        echo "✗ Error creating product '{$product['name']}': " . $e->getMessage() . "\n";
    }
}

echo "\n";

// Find or create test customer
echo "STEP 2: Setting up test customer 'Dreamzone Test'\n";
echo "─────────────────────────────────────────────────────────────\n";

try {
    $customer = Customer::firstOrCreate(
        ['email' => 'test@dreamzone.com'],
        [
            'name' => 'Dreamzone Test',
            'phone' => '555-0123',
            'password' => bcrypt('password123'),
            'status' => 'activated',
        ]
    );
    
    echo "✓ Customer: {$customer->name} ({$customer->email})\n";
    echo "  ID: {$customer->id}\n";
    
} catch (\Exception $e) {
    echo "✗ Error creating customer: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n";

// Create test orders
echo "STEP 3: Creating 10 test orders (one per product, different dates)\n";
echo "─────────────────────────────────────────────────────────────\n";

$createdOrders = [];

foreach ($createdProducts as $idx => $data) {
    try {
        $order = new Order();
        $order->user_id = $customer->id;
        $order->code = 'REZTEST' . date('YmdHis') . str_pad($idx + 1, 2, '0', STR_PAD_LEFT);
        $order->description = 'Rezgo Test - ' . $data['product']->name . ' (' . $data['date'] . ')';
        $order->status = 'pending';
        $order->amount = $data['price'];
        $order->sub_total = $data['price'];
        $order->save();
        
        // Create order line item
        $orderProduct = new OrderProduct();
        $orderProduct->order_id = $order->id;
        $orderProduct->product_id = $data['product']->id;
        $orderProduct->product_name = $data['product']->name;
        $orderProduct->qty = 1;
        $orderProduct->price = $data['price'];
        $orderProduct->tax_amount = 0;
        $orderProduct->product_type = 'physical';
        $orderProduct->save();
        
        echo "✓ Order #{$order->id} | Code: {$order->code}\n";
        echo "  Product: {$data['product']->name}\n";
        echo "  Date: {$data['date']} | Price: \${$data['price']}\n";
        
        $createdOrders[] = $order;
        
    } catch (\Exception $e) {
        echo "✗ Error creating order: " . $e->getMessage() . "\n";
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
echo "✓ Customer: Dreamzone Test (test@dreamzone.com)\n";
echo "✓ Products Created: " . count($createdProducts) . " test products\n";
echo "  - 5 Universal Orlando tickets (1-day, 2-day, 3-day, Express 1P, Express 2P)\n";
echo "  - 5 Disney Parks tickets (1-day Hopper, 1-day MK, 2-day, 3-day, 4-day)\n";
echo "✓ Orders Created: " . count($createdOrders) . " test orders\n";
echo "  - Each order: Different product, different booking date\n";
echo "  - Order IDs: " . implode(', ', array_map(fn($o) => '#' . $o->id, $createdOrders)) . "\n";
echo "\n";

echo "DATES ASSIGNED:\n";
echo "────────────────────────────────────────────────────────────\n";
foreach ($createdProducts as $idx => $data) {
    echo ($idx + 1) . ". {$data['product']->name}\n";
    echo "   Booking Date: {$data['date']}\n";
}

echo "\n";
echo "READY FOR REZGO SUBMISSION ✓\n";
echo "\n";
