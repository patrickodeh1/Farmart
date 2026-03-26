# REZGO Connector Pre-Test Setup - Implementation Summary

## Overview
All required fixes have been implemented to prepare the Rezgo Connector plugin for end-to-end order testing on the Farmart Laravel e-commerce platform.

## Changes Made

### 1. **Database Schema Updates** (Migration File)
**File:** `platform/plugins/rezgo-connector/database/migrations/2024_03_11_000000_create_rezgo_tables.php`

**Changes:**
- ✅ Added margin tracking columns to `rezgo_product_mappings` table:
  - `cost_price` (decimal 10,2) - What Farmart pays Rezgo
  - `sell_price` (decimal 10,2) - What customer pays in Farmart
  - `margin_amount` (decimal 10,2) - Sell price minus cost price
  - `margin_percent` (decimal 5,2) - Margin as percentage of sell price

- ✅ Added new `rezgo_meta` table to store Rezgo metadata against orders:
  - Stores `rezgo_booking_id`, `tour_uid`, `tour_title`, `passenger_count`
  - Includes `tour_date`, passenger data, and full API responses (JSON)
  - Linked to `ec_orders` table via foreign key

**Impact:** Enables margin tracking and order metadata requirements from PRD.

---

### 2. **Empty UID Guard** (Security)
**File:** `platform/plugins/rezgo-connector/src/Listeners/SubmitOrderToRezgo.php`

**Change:**
- ✅ Added mandatory guard before API submission:
```php
if (empty($bookingData['book'])) {
    RezgoLog::warning(
        'submit_order',
        $order->id,
        'Skipping — no tour UID mapped for product ' . ($firstItem->product_id ?? 'unknown')
    );
    return;
}
```

**Impact:** Prevents empty/null tour UIDs from being submitted to Rezgo API, protecting against booking failures and invalid transactions.

---

### 3. **Dual Logging to Database + File** (Audit Trail)
**File:** `platform/plugins/rezgo-connector/src/Models/RezgoLog.php`

**Changes:**
- ✅ Added `use Illuminate\Support\Facades\Log;` import
- ✅ Updated all four static methods to log to both database AND file:
  - `sync()` - Info level logs
  - `error()` - Error level logs
  - `warning()` - Warning level logs  
  - `info()` - Info level logs

Each method now calls:
```php
Log::channel('rezgo')->{level}('[TYPE] ' . $operation . ' - ' . $message, $context);
```

**Impact:** Every booking attempt is logged to both `rezgo_logs` table AND `/var/www/html/storage/logs/rezgo-sync.log` for full audit trail and troubleshooting.

---

### 4. **Logging Channel Configuration**
**File:** `platform/plugins/rezgo-connector/src/Providers/RezgoConnectorServiceProvider.php`

**Change:**
- ✅ Added logging channel registration in `boot()` method:
```php
config(['logging.channels.rezgo' => [
    'driver' => 'daily',
    'path'   => storage_path('logs/rezgo-sync.log'),
    'level'  => 'debug',
    'days'   => 14,
]]);
```

**Impact:** Ensures dedicated Rezgo logging channel is configured on plugin boot, with daily log rotation and 14-day retention.

---

### 5. **Product Mapping Model Updates**
**File:** `platform/plugins/rezgo-connector/src/Models/RezgoProductMapping.php`

**Changes:**
- ✅ Added margin columns to `$fillable` array:
  - `cost_price`, `sell_price`, `margin_amount`, `margin_percent`

- ✅ Extended `$casts` to include new decimal columns:
```php
protected $casts = [
    'is_active' => 'boolean',
    'rezgo_price' => 'decimal:2',
    'cost_price' => 'decimal:2',
    'sell_price' => 'decimal:2',
    'margin_amount' => 'decimal:2',
    'margin_percent' => 'decimal:2',
];
```

**Impact:** Enables mass assignment and proper decimal handling for all pricing and margin fields.

---

## Verification Checklist

### Pre-Deployment Verification (Code Review - ✅ Complete)
- ✅ Migration file includes all 5 required tables: `rezgo_settings`, `rezgo_product_mappings`, `rezgo_submissions`, `rezgo_logs`, `rezgo_meta`
- ✅ Margin columns added to `rezgo_product_mappings`
- ✅ `rezgo_meta` table created with proper structure
- ✅ Empty UID guard implemented in SubmitOrderToRezgo listener
- ✅ Dual logging (database + file) configured in RezgoLog model
- ✅ Logging channel configured in ServiceProvider
- ✅ RezgoProductMapping model updated with fillable and casts

### Deployment Steps (Run on Docker Container)

The pre-test setup script has been created: **`REZGO_PRETEST_SETUP.sh`**

This script will:
1. **Run pending migrations** - Creates/updates all tables
2. **Verify all 5 tables exist** - Confirms schema created successfully
3. **Verify margin columns** - Confirms pricing columns present
4. **Configure settings** - Inserts API credentials (CID: 32036, Key: 9B8-D1V1-V2C8-H4O5-O7Q)
5. **Set product mappings** - Maps products 154 & 155 to Rezgo UIDs 418065 & 418066
6. **Test logging channel** - Verifies rezgo-sync.log is writable
7. **Verify empty UID guard** - Confirms guard code is present
8. **Test API connection** - Verifies Rezgo API connectivity
9. **Clear all caches** - Ensures fresh configuration
10. **Run final test booking** - Validates end-to-end flow

---

## How to Run the Setup Script

### Prerequisites
- Docker container `farmart_app` must be running
- SSH access or terminal to the VPS

### Run the Script

```bash
# Navigate to project root
cd /home/soarer/Projects/new/farmart

# Make script executable
chmod +x REZGO_PRETEST_SETUP.sh

# Run the setup script
./REZGO_PRETEST_SETUP.sh
```

### Expected Output
```
═══════════════════════════════════════════════════════════════
REZGO CONNECTOR - PRE-TEST SETUP VERIFICATION
═══════════════════════════════════════════════════════════════

STEP 1: Running Pending Migrations
...
STEP 10: Running Final Booking Test
...
═══════════════════════════════════════════════════════════════
SETUP VERIFICATION SUMMARY
═══════════════════════════════════════════════════════════════
Passed: 9
Failed: 0

✓ SYSTEM READY FOR TESTING

SUCCESS CRITERIA MET:
  ✅ All 5 database tables exist
  ✅ Margin columns exist on rezgo_product_mappings
  ✅ sync_enabled = 1
  ✅ CID and API key are set and encrypted
  ✅ At least 2 active product mappings (UIDs 418065 and 418066)
  ✅ rezgo-sync.log file logging configured
  ✅ Empty UID guard in place
  ✅ API connection verified
  ✅ Cache cleared and ready

Next: Proceed to storefront order testing
```

---

## Individual Command Reference

### Run Migrations Manually
```bash
docker exec -i farmart_app php artisan migrate
```

### Verify Tables
```bash
docker exec -i farmart_app php artisan tinker --execute="
\$tables = ['rezgo_submissions','rezgo_product_mappings','rezgo_logs','rezgo_settings','rezgo_meta'];
foreach(\$tables as \$t) {
    echo \$t . ': ' . (DB::getSchemaBuilder()->hasTable(\$t) ? 'EXISTS' : 'MISSING') . PHP_EOL;
}
"
```

### Verify Margin Columns
```bash
docker exec -i farmart_app php artisan tinker --execute="
\$cols = DB::getSchemaBuilder()->getColumnListing('rezgo_product_mappings');
foreach(['cost_price','sell_price','margin_amount','margin_percent'] as \$c) {
    echo \$c . ': ' . (in_array(\$c,\$cols) ? 'EXISTS' : 'MISSING') . PHP_EOL;
}
"
```

### Configure Settings & Enable Sync
```bash
docker exec -i farmart_app php artisan tinker --execute="
\$settings = [
    'rezgo_cid'=>'32036',
    'rezgo_api_key'=>'9B8-D1V1-V2C8-H4O5-O7Q',
    'sync_enabled'=>'1',
    'default_passenger_type'=>'adult',
    'booking_date_offset'=>'1'
];
foreach(\$settings as \$k=>\$v) {
    DB::table('rezgo_settings')->updateOrInsert(
        ['setting_key'=>\$k],
        ['setting_value'=>encrypt(\$v)]
    );
}
echo 'Settings saved' . PHP_EOL;
"
```

### Add Product Mappings
```bash
docker exec -i farmart_app php artisan tinker --execute="
DB::table('rezgo_product_mappings')->updateOrInsert(
    ['product_id'=>154],
    ['rezgo_uid'=>'418065','rezgo_title'=>'Universal Orlando - 1-Day Base Ticket','passenger_type'=>'adult','is_active'=>1]
);
DB::table('rezgo_product_mappings')->updateOrInsert(
    ['product_id'=>155],
    ['rezgo_uid'=>'418066','rezgo_title'=>'Universal Orlando - 2-Day Base Ticket','passenger_type'=>'adult','is_active'=>1]
);
echo 'Mappings confirmed' . PHP_EOL;
"
```

### Test API Connection
```bash
docker exec -i farmart_app php artisan tinker --execute="
\$result = app(Botble\RezgoConnector\Services\RezgoApiService::class)->getCompanyInfo();
echo 'API: ' . (\$result['success'] ? 'CONNECTED' : 'FAILED') . PHP_EOL;
"
```

### Test Logging
```bash
docker exec -i farmart_app php artisan tinker --execute="
\Illuminate\Support\Facades\Log::channel('rezgo')->info('Test log entry');
echo 'Log written' . PHP_EOL;
"
docker exec -i farmart_app ls -la /var/www/html/storage/logs/ | grep rezgo
```

### Clear All Cache
```bash
docker exec -i farmart_app php artisan optimize:clear
docker exec -i farmart_app php artisan cache:clear
docker exec -i farmart_app php artisan config:clear
docker exec -i farmart_app php artisan route:clear
docker exec -i farmart_app php artisan view:clear
```

### Run Final Test Booking
```bash
docker exec -i farmart_app php artisan tinker --execute="
\$result = app(Botble\RezgoConnector\Services\RezgoApiService::class)->commitBooking([
    'order_id'=>0,
    'book'=>'418065',
    'date'=>'2026-03-24',
    'adult_num'=>1,
    'tour_first_name'=>'Dreamzone',
    'tour_last_name'=>'Test',
    'tour_email_address'=>'test@dreamzone.com',
    'tour_phone_number'=>'4075550123',
    'tour_address_1'=>'123 Main St',
    'tour_city'=>'Orlando',
    'tour_stateprov'=>'FL',
    'tour_postal_code'=>'32801',
    'tour_country'=>'US',
]);
echo 'Result: ' . (\$result['success'] ? 'SUCCESS - Trans: '.\$result['trans_num'] : 'FAILED - '.\$result['error']) . PHP_EOL;
"
```

---

## Files Modified

1. **`platform/plugins/rezgo-connector/database/migrations/2024_03_11_000000_create_rezgo_tables.php`**
   - Added 4 margin columns to `rezgo_product_mappings`
   - Added complete `rezgo_meta` table definition
   - Updated `down()` method to drop new table

2. **`platform/plugins/rezgo-connector/src/Listeners/SubmitOrderToRezgo.php`**
   - Added empty UID guard before API submission

3. **`platform/plugins/rezgo-connector/src/Models/RezgoLog.php`**
   - Added Log facade import
   - Updated sync() method to call Log::channel()
   - Updated error() method to call Log::channel()
   - Updated warning() method to call Log::channel()
   - Updated info() method to call Log::channel()

4. **`platform/plugins/rezgo-connector/src/Providers/RezgoConnectorServiceProvider.php`**
   - Added logging channel configuration in boot() method

5. **`platform/plugins/rezgo-connector/src/Models/RezgoProductMapping.php`**
   - Added margin columns to $fillable array
   - Extended $casts to include new decimal columns

6. **`REZGO_PRETEST_SETUP.sh`** (New File)
   - Comprehensive setup and verification script

---

## Success Criteria Status

| Criterion | Status |
|-----------|--------|
| All 5 database tables exist | ✅ Code Ready |
| Margin columns on rezgo_product_mappings | ✅ Code Ready |
| sync_enabled = 1 | ✅ Script Handles |
| CID and API key set and encrypted | ✅ Script Handles |
| 2+ active product mappings (UIDs 418065, 418066) | ✅ Script Handles |
| rezgo-sync.log file logging | ✅ Code Ready |
| Empty UID guard in place | ✅ Code Ready |
| API connection verified | ✅ Script Tests |
| Cache cleared and ready | ✅ Script Handles |

---

## Next Steps

1. **Copy updated plugin to VPS** (if not already synced)
2. **Run the setup script:**
   ```bash
   ./REZGO_PRETEST_SETUP.sh
   ```
3. **Verify all checks pass** - Script will report SUCCESS or FAILED
4. **Proceed to storefront order testing** - Once all criteria met

---

## Troubleshooting

### If migrations fail
```bash
docker exec -i farmart_app php artisan migrate:refresh --path=platform/plugins/rezgo-connector/database/migrations
```

### If logging channel not found
Clear config cache:
```bash
docker exec -i farmart_app php artisan config:clear
```

### If API test fails
Verify credentials are set:
```bash
docker exec -i farmart_app php artisan tinker --execute="
echo 'CID: ' . config('app.rezgo_cid') . PHP_EOL;
echo 'Key: ' . substr(DB::table('rezgo_settings')->where('setting_key','rezgo_api_key')->value('setting_value'),0,10) . '...' . PHP_EOL;
"
```

### Log file not created
Logs are created on first event. Trigger by running a test booking or manually testing the logging channel.

---

## Support
For additional issues, review:
- `/var/www/html/storage/logs/rezgo-sync.log` - Real-time logging
- `rezgo_logs` table - Database audit trail
- `rezgo_submissions` table - Booking submission history

