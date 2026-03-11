# Rezgo Integration - Test Data Setup Guide

## Overview

This guide walks you through setting up and running the comprehensive Rezgo integration tests to verify the plugin is working correctly.

## Pre-requisites

✅ Plugin installed and activated
✅ Rezgo credentials configured in admin panel
✅ Test connection successful

## Step 1: Run the Test Data Setup Command

On your VPS, run the artisan command to create test products and orders:

```bash
cd /var/www/html
# Activate the plugin if not already done
php artisan plugin:activate rezgo-connector

# Run migrations if not already done
php artisan migrate

# Run the test data setup
php artisan rezgo:setup-test-data --update-existing
```

This command will:

1. **Update the existing "John Doe" submission** to show "Dreamzone Test" as the customer name
2. **Fetch all 12 available Rezgo tours** from your account
3. **Create 10 Farmart test products** (5 Universal Orlando + 5 Disney)
4. **Create product-to-tour mappings** linking each product to a Rezgo tour
5. **Create a test customer** account (email: test@dreamzone.com)
6. **Create 10 test orders** (one for each product)

## Step 2: Verify Submissions Page

After running the command, navigate to the submissions page:

**URL:** `http://173.212.248.146:8002/admin/rezgo/submissions`

You should see:
- All 10 test orders listed
- Each showing order ID, Rezgo Booking ID, status, and timestamp
- Dreamzone Test as the customer name (updated from John Doe)
- Various HTTP status codes and response data

**If you see errors:**

The most common errors are:

### Error 1: "Call to undefined method order()"
**Solution:** Make sure the migration has run:
```bash
php artisan migrate
```

### Error 2: Route not found or pages not loading
**Solution:** Clear caches and rebuild routes:
```bash
php artisan route:cache --tags=rezgo
php artisan view:cache
php artisan config:cache
```

### Error 3: Products not showing order details
**Solution:** Verify the `ec_orders` table has the created orders:
```bash
mysql -u farmart_user -p'farmart_password' farmart -e "SELECT id, code, user_id FROM ec_orders LIMIT 10;"
```

## Step 3: Verify Test Orders Trigger Rezgo API

The test orders created by the command are in "pending" status. To trigger the Rezgo API submission:

**Option A: Via Admin Panel (Manual)**
1. Go to each order and mark it as "Placed" or "Confirmed"
2. This will trigger the `OrderPlacedEvent`
3. The plugin will automatically submit to Rezgo

**Option B: Via Database (Bulk)**
```bash
# Update all test orders to status that triggers the event
php artisan tinker << 'EOF'
$orders = \Botble\Ecommerce\Models\Order::where('code', 'like', 'REZTEST%')->get();
foreach ($orders as $order) {
    event(new \Botble\Ecommerce\Events\OrderPlacedEvent($order));
}
echo "Triggered " . count($orders) . " order events\n";
EOF
```

## Step 4: Check Rezgo Backend

Log in to your Rezgo account at `https://admin.rezgo.com`

You should see:
- 10 new bookings from "Dreamzone Test"
- Different tour types (Universal and Disney)
- Transaction numbers (trans_num) for each booking
- Booking dates spread across different days

## Step 5: Verify Submissions Page Shows Live Data

Back in Farmart admin, go to `/admin/rezgo/submissions`:

You should now see:
- All 10 orders with "success" status badge
- HTTP 200 status codes
- Rezgo Booking IDs populated
- Click "View" on any submission to see:
  - Full request payload sent to Rezgo
  - Full response from Rezgo (including trans_num)
  - Customer name: "Dreamzone Test"
  - Tour information

## Troubleshooting

### Submissions Show "Failed" Status

1. Check the error message in submission detail view
2. Check Activity Logs: `/admin/rezgo/logs`
3. Common issues:
   - Passenger counts don't match order items
   - Billing information missing
   - Invalid booking date
   - Tour UID no longer available

**Solution:**
```bash
# Check logs for details
php artisan tinker << 'EOF'
$logs = \Botble\RezgoConnector\Models\RezgoLog::whereLogType('error')->latest()->limit(5)->get();
foreach ($logs as $log) {
    echo "Error in {$log->operation}: {$log->message}\n";
    if ($log->context) {
        echo "  Context: " . json_encode($log->context) . "\n";
    }
}
EOF
```

### Products Not Showing Full Details

Make sure all required fields are populated:

```bash
php artisan tinker << 'EOF'
$products = \Botble\Ecommerce\Models\Product::whereIn('slug', [
    'universal-orlando-express-pass',
    'disney-magic-kingdom'
    // ... etc
])->get();

foreach ($products as $p) {
    echo $p->name . ": " . ($p->price ?? 'NO PRICE') . "\n";
}
EOF
```

### John Doe Not Updated

Re-run with update flag:

```bash
php artisan rezgo:setup-test-data --update-existing
```

## Expected Results

When everything is working correctly:

✅ 10 test products visible in Farmart
✅ 10 test orders created with "Dreamzone Test" customer
✅ All orders appear in submissions page
✅ Orders trigger Rezgo API automatically (or manually)
✅ Rezgo Backend shows 10 new "Dreamzone Test" bookings
✅ Submissions page shows response data and booking IDs
✅ Activity logs show successful sync operations
✅ No errors in exception logs

## Next Steps

Once testing is complete:

1. **Review the data**: Check both Farmart and Rezgo to ensure everything matches
2. **Test validation**: Try creating an order via the storefront to ensure it automatically submits
3. **Configure product mappings**: Map your real products to Rezgo tours
4. **Enable auto-sync**: In settings, enable "Order Synchronization" for production
5. **Monitor logs**: Keep an eye on Activity Logs for any issues

## Support

If you encounter issues:

1. Check `/storage/logs/rezgo-sync.log` for detailed errors
2. Check Activity Logs in admin panel
3. Review submission detail pages for API response details
4. Check database directly for orders and submissions

```bash
# List all test orders
mysql -u farmart_user -p'farmart_password' farmart << 'SQL'
SELECT o.id, o.code, o.user_id, o.status, r.status as rezgo_status, r.rezgo_booking_id
FROM ec_orders o
LEFT JOIN rezgo_submissions r ON r.order_id = o.id
WHERE o.code LIKE 'REZTEST%'
ORDER BY o.id DESC;
SQL
```

## Cleanup

To remove test data:

```bash
# Delete all test orders
php artisan tinker << 'EOF'
$deleted = \Botble\Ecommerce\Models\Order::where('code', 'like', 'REZTEST%')->delete();
echo "Deleted $deleted test orders\n";
EOF
```

---

**Questions?** Check the plugin README.md for additional documentation.
