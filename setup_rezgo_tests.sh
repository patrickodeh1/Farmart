#!/bin/bash

# This script sets up test data for Rezgo testing on the VPS
# Run this on the VPS: bash setup_rezgo_tests.sh

APP_PATH="/var/www/html"
DOCKER_EXEC="docker exec farmart_app"

echo "=== REZGO TEST DATA SETUP ==="
echo ""

# Step 1: Update existing submission
echo "Step 1: Updating existing submission to 'Dreamzone Test'..."
$DOCKER_EXEC php artisan tinker << 'TINKER_EOF'
$sub = \Botble\RezgoConnector\Models\RezgoSubmission::where('status', 'success')->first();
if ($sub) {
    $req = json_decode($sub->request_payload, true);
    $req['tour_first_name'] = 'Dreamzone';
    $req['tour_last_name'] = 'Test';
    $req['customer_email'] = 'test@dreamzone.com';
    $sub->request_payload = json_encode($req);
    $sub->save();
    echo "✓ Updated submission\n";
}
TINKER_EOF
echo ""

# Step 2: Get tours and create products
echo "Step 2: Creating test products..."
$DOCKER_EXEC php artisan tinker << 'TINKER_EOF'
$api = new \Botble\RezgoConnector\Services\RezgoApiService();
$tours = $api->searchInventory([]);

if (!isset($tours['data']['item'])) {
    echo "✗ Could not fetch tours\n";
    exit(1);
}

$items = $tours['data']['item'];
$items = is_array($items) && isset($items[0]) ? $items : [$items];

$universal = [];
$disney = [];

foreach ($items as $tour) {
    $name = strtolower($tour['tour_name'] ?? '');
    if (strpos($name, 'universal') !== false) {
        $universal[] = $tour;
    } elseif (strpos($name, 'disney') !== false) {
        $disney[] = $tour;
    }
}

$selected = array_merge(
    array_slice($universal, 0, 5),
    array_slice($disney, 0, 5)
);

if (count($selected) < 10) {
    $other = array_slice($items, count($selected), 10 - count($selected));
    $selected = array_merge($selected, $other);
}

echo "Creating products for " . count($selected) . " tours...\n";

$products = [];
foreach (array_slice($selected, 0, 10) as $tour) {
    $product = \Botble\Ecommerce\Models\Product::firstOrCreate(
        ['name' => $tour['tour_name']],
        [
            'slug' => \Illuminate\Support\Str::slug($tour['tour_name']),
            'description' => 'Rezgo: ' . $tour['tour_name'],
            'status' => 'published',
            'price' => (float)($tour['rate_period'] ?? 299.99),
            'quantity' => 100,
        ]
    );
    
    \Botble\RezgoConnector\Models\RezgoProductMapping::updateOrCreate(
        ['product_id' => $product->id],
        [
            'rezgo_uid' => $tour['uid'],
            'rezgo_title' => $tour['tour_name'],
            'passenger_type' => 'adult',
            'is_active' => true,
        ]
    );
    
    $products[] = ['id' => $product->id, 'name' => $product->name];
    echo "  ✓ " . $product->name . "\n";
}

// Save products for next step
file_put_contents('/tmp/test_products.json', json_encode($products));
echo "✓ Products created: " . count($products) . "\n";
TINKER_EOF
echo ""

# Step 3: Create test orders
echo "Step 3: Creating test orders..."
$DOCKER_EXEC php artisan tinker << 'TINKER_EOF'
$products = json_decode(file_get_contents('/tmp/test_products.json'), true);

// Get or create test customer
$user = \Botble\Ecommerce\Models\Customer::where('email', 'test@dreamzone.com')->first();
if (!$user) {
    $user = \Botble\Ecommerce\Models\Customer::create([
        'first_name' => 'Dreamzone',
        'last_name' => 'Test',
        'email' => 'test@dreamzone.com',
        'phone' => '555-1234',
        'password' => bcrypt('password123'),
        'is_active' => true,
    ]);
    echo "✓ Created test customer\n";
} else {
    echo "✓ Using existing test customer\n";
}

// Create orders
$dates = [];
$now = now();
for ($i = 0; $i < 10; $i++) {
    $dates[] = $now->clone()->addDays($i + 2)->format('Y-m-d');
}

foreach ($products as $index => $product) {
    $order = new \Botble\Ecommerce\Models\Order();
    $order->user_id = $user->id;
    $order->code = 'REZGO' . date('YmdHis') . $index;
    $order->description = 'Test order for ' . $product['name'];
    $order->status = 'pending';
    $order->payment_status = 'pending';
    $order->total = 299.99;
    $order->save();
    
    // Create order product
    $orderProduct = new \Botble\Ecommerce\Models\OrderProduct();
    $orderProduct->order_id = $order->id;
    $orderProduct->product_id = $product['id'];
    $orderProduct->product_name = $product['name'];
    $orderProduct->qty = 1;
    $orderProduct->price = 299.99;
    $orderProduct->save();
    
    echo "  ✓ Order #" . $order->id . " - " . $product['name'] . "\n";
}

echo "✓ Created " . count($products) . " test orders\n";
TINKER_EOF

echo ""
echo "=== COMPLETE ==="
echo "Test orders created and ready for submission"
echo ""
