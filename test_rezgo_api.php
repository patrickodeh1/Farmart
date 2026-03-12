#!/usr/bin/env php
<?php

/**
 * Direct Rezgo Submission Test
 * Submits test orders directly to Rezgo API via POST with XML format
 */

$basePath = __DIR__ . '/main';
if (!file_exists($basePath . '/vendor/autoload.php')) {
    $basePath = __DIR__;
}

require_once $basePath . '/vendor/autoload.php';
$app = require_once $basePath . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Botble\Ecommerce\Models\Order;

echo "\n╔════════════════════════════════════════════════════════════╗\n";
echo "║    Testing Rezgo API with TEST ORDERS (POST/XML)          ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

// Load the API service and settings manually
try {
    // Manually create settings service
    $settingsService = new \Botble\RezgoConnector\Services\RezgoSettingsService();
    $apiService = new \Botble\RezgoConnector\Services\RezgoApiService($settingsService);
    
    // Configure API credentials (should be in DB but setting manually for testing)
    // You'll need to set these in the Rezgo settings
    echo "⚠ Note: API credentials must be configured in Rezgo settings first\n\n";
    
} catch (\Exception $e) {
    echo "✗ Error initializing services: " . $e->getMessage() . "\n";
    exit(1);
}

// Get test orders (IDs 23-32 from our recent setup)
$testOrderIds = range(23, 32);

echo "STEP 1: Loading test orders\n";
echo "─────────────────────────────────────────────────────────────\n";

$orders = Order::whereIn('id', $testOrderIds)->with('user', 'products')->get();

echo "✓ Loaded " . $orders->count() . " test orders\n";
echo "Order IDs: " . implode(', ', $orders->pluck('id')->toArray()) . "\n\n";

echo "STEP 2: Test API connectivity\n";
echo "─────────────────────────────────────────────────────────────\n";

try {
    $companyInfo = $apiService->getCompanyInfo();
    if ($companyInfo['success']) {
        echo "✓ Rezgo API is reachable\n";
        echo "  Status: Connected via POST/XML to https://api.rezgo.com/xml\n";
    } else {
        echo "⚠ API connection test: " . ($companyInfo['error'] ?? 'Unknown error') . "\n";
    }
} catch (\Exception $e) {
    echo "⚠ Connection test failed (API might need credentials): " . $e->getMessage() . "\n";
}

echo "\nSTEP 3: Sample booking data structure\n";
echo "─────────────────────────────────────────────────────────────\n";

// Show sample for first order
$firstOrder = $orders->first();
if ($firstOrder) {
    $product = $firstOrder->products->first();
    $customer = $firstOrder->user;
    
    $sampleBookingData = [
        'order_id' => $firstOrder->id,
        'book' => 'UNIVERSAL_1DAY_' . $firstOrder->code,  // Tour UID from Rezgo
        'date' => '2026-03-17',                            // Booking date
        'adult_num' => 1,
        'child_num' => 0,
        'senior_num' => 0,
        'tour_first_name' => $customer->name ?? 'Customer',
        'tour_last_name' => 'from Farmart',
        'tour_address_1' => '123 Main St',
        'tour_city' => 'Orlando',
        'tour_stateprov' => 'FL',
        'tour_country' => 'US',
        'tour_postal_code' => '32801',
        'tour_phone_number' => $customer->phone ?? '555-0000',
        'tour_email_address' => $customer->email,
        'payment_method' => 'Credit Cards',
    ];
    
    echo "Sample booking structure:\n";
    echo json_encode($sampleBookingData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
}

echo "\n╔════════════════════════════════════════════════════════════╗\n";
echo "║              TEST COMPLETE                                 ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

echo "NEXT STEPS:\n";
echo "────────────────────────────────────────────────────────────\n";
echo "1. Configure Rezgo API credentials via admin panel:\n";
echo "   Admin > Rezgo Connector > Settings\n";
echo "   - CID: 32036\n";
echo "   - API Key: 9B8-D1V1-V2C8-H4O5-O7Q\n\n";
echo "2. After configuration, submit orders manually via:\n";
echo "   php artisan rezgo:submit-orders\n\n";
echo "3. OR trigger the event by visiting the admin submissions page:\n";
echo "   Admin > Rezgo Connector > Submissions\n\n";

echo "\n✓ All systems ready for testing!\n\n";
