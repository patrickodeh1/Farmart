#!/usr/bin/env php
<?php

// Set up the application
$basePath = __DIR__;
require_once $basePath . '/main/vendor/autoload.php';

$app = require_once $basePath . '/main/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Botble\RezgoConnector\Models\{RezgoSubmission, RezgoProductMapping};
use Botble\RezgoConnector\Services\{RezgoApiService, RezgoSettingsService};
use Botble\Ecommerce\Models\Product;
use Botble\Ecommerce\Models\Order;
use Botble\Base\Models\BaseModel;

echo "\n=== REZGO TEST DATA SETUP ===\n\n";

// Step 1: Update existing John Doe submission
echo "Step 1: Updating existing John Doe submission to Dreamzone Test...\n";
$existingSubmission = RezgoSubmission::where('status', 'success')->first();
if ($existingSubmission) {
    $request = json_decode($existingSubmission->request_payload, true);
    $request['tour_first_name'] = 'Dreamzone';
    $request['tour_last_name'] = 'Test';
    $request['customer_email'] = 'test@dreamzone.com';
    $existingSubmission->request_payload = json_encode($request);
    $existingSubmission->save();
    echo "✓ Updated submission #" . $existingSubmission->id . "\n";
} else {
    echo "✗ No existing submission found\n";
}

// Step 2: Get available Rezgo tours
echo "\nStep 2: Fetching available Rezgo tours...\n";
$api = new RezgoApiService();
$toursResponse = $api->searchInventory([]);

$rezgoTours = [];
if (isset($toursResponse['data']['item'])) {
    $items = $toursResponse['data']['item'];
    $items = is_array($items) && isset($items[0]) ? $items : [$items];
    $rezgoTours = array_slice($items, 0, 15);
}

echo "Found " . count($rezgoTours) . " tours\n";

// Separate Universal and Disney tours
$universalTours = [];
$disneyTours = [];

foreach ($rezgoTours as $tour) {
    $name = strtolower($tour['tour_name'] ?? '');
    if (strpos($name, 'universal') !== false) {
        $universalTours[] = $tour;
    } elseif (strpos($name, 'disney') !== false) {
        $disneyTours[] = $tour;
    }
}

echo "  - Universal tours: " . count($universalTours) . "\n";
echo "  - Disney tours: " . count($disneyTours) . "\n";

// Take first 5 of each
$testUniversal = array_slice($universalTours, 0, 5);
$testDisney = array_slice($disneyTours, 0, 5);
$selectedTours = array_merge($testUniversal, $testDisney);

if (count($selectedTours) < 10) {
    $remaining = 10 - count($selectedTours);
    $otherTours = array_slice($rezgoTours, 0, $remaining);
    $selectedTours = array_merge($selectedTours, $otherTours);
}

echo "\nSelected " . count($selectedTours) . " tours for testing:\n";
foreach (array_slice($selectedTours, 0, 10) as $i => $tour) {
    echo "  " . ($i + 1) . ". " . $tour['tour_name'] . " (UID: " . $tour['uid'] . ")\n";
}

// Step 3: Create or find Farmart products
echo "\n\nStep 3: Creating Farmart products...\n";
$testProducts = [];
foreach (array_slice($selectedTours, 0, 10) as $i => $tour) {
    $productName = $tour['tour_name'];
    
    // Check if product exists by name
    $product = Product::where('name', $productName)->first();
    
    if (!$product) {
        // Create new product
        $product = new Product();
        $product->name = $productName;
        $product->slug = \Illuminate\Support\Str::slug($productName);
        $product->description = "Test product for Rezgo tour: " . $tour['tour_name'];
        $product->content = "This is a test product linked to Rezgo tour: " . $tour['tour_name'];
        $product->status = 'published';
        $product->price = (float)($tour['rate_period'] ?? 0) ?: 299.99;
        $product->quantity = 100;
        $product->save();
        echo "  ✓ Created product: " . $productName . " (ID: " . $product->id . ")\n";
    } else {
        echo "  ✓ Found existing product: " . $productName . " (ID: " . $product->id . ")\n";
    }
    
    // Create or update product mapping
    $mapping = RezgoProductMapping::updateOrCreate(
        ['product_id' => $product->id],
        [
            'rezgo_uid' => $tour['uid'],
            'rezgo_title' => $tour['tour_name'],
            'passenger_type' => 'adult',
            'is_active' => true,
        ]
    );
    
    $testProducts[] = [
        'product' => $product,
        'tour' => $tour,
        'mapping' => $mapping,
    ];
}

echo "\n✓ Created/updated " . count($testProducts) . " products and mappings\n";

// Step 4: Create test orders
echo "\n\nStep 4: Creating test orders...\n";
echo "This requires creating orders with Dreamzone Test as customer.\n";
echo "Please note: This script has set up the products. Orders must be created via the UI\n";
echo "or by providing additional database configuration for user accounts.\n";

// Display summary
echo "\n\n=== SETUP SUMMARY ===\n";
echo "✓ Updated existing submission to use 'Dreamzone Test'\n";
echo "✓ Created " . count($testProducts) . " products in Farmart\n";
echo "✓ Created " . count($testProducts) . " product-to-Rezgo tour mappings\n";
echo "\nNext steps:\n";
echo "1. Create 10 test orders (1 per product) with 'Dreamzone Test' as customer\n";
echo "2. Verify orders appear in /admin/rezgo/submissions\n";
echo "3. Check Rezgo backend for 'Dreamzone Test' bookings\n";
echo "\n";

echo "Products created:\n";
foreach ($testProducts as $i => $data) {
    echo "  " . ($i + 1) . ". {$data['product']->name} (ID: {$data['product']->id})\n";
    echo "     → Rezgo UID: " . $data['tour']['uid'] . "\n";
}

echo "\n=== COMPLETE ===\n\n";
