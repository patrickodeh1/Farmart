# Rezgo Connector Plugin

A professional Botble Farmart plugin for seamless integration with the Rezgo tour booking API. Enables automated order submission, inventory synchronization, and comprehensive activity tracking.

## Features

- **Automated Order Submission**: Automatically sends orders to Rezgo API via `OrderPlacedEvent`
- **Encrypted Credentials**: Sensitive API keys stored with encryption
- **Product-Tour Mapping**: Map Farmart products to specific Rezgo tours
- **Admin Dashboard**: Complete UI for configuration, monitoring, and management
- **Activity Logging**: Dual file + database logging of all operations
- **Inventory Sync**: Fetch available tours directly from Rezgo API
- **Submission Tracking**: View detailed request/response data for each submission
- **Error Handling**: Comprehensive error logging with recovery options
- **Update-Proof**: Built as modular plugin, survives Botble framework updates

## Installation

### Prerequisites
- Botble Farmart CMS (Laravel 12+)
- PHP 8.2+
- MySQL 8.0+
- Valid Rezgo API credentials (CID + API Key)

### Steps

1. **Enable Plugin** (if not already activated):
   ```bash
   php artisan plugin:activate rezgo-connector
   ```

2. **Run Migrations** to create database tables:
   ```bash
   php artisan migrate
   ```
   
   This creates 4 tables:
   - `rezgo_settings` - API credentials and sync configuration
   - `rezgo_product_mappings` - Farmart product to Rezgo tour relationships
   - `rezgo_submissions` - Order submission history with request/response data
   - `rezgo_logs` - Activity audit trail

3. **Configure Rezgo Credentials**:
   - Navigate to: **Admin Panel → Rezgo Connector → Settings**
   - Enter your Rezgo CID (Company ID)
   - Enter your Rezgo API Key
   - Select default passenger type (Adult/Child/Senior)
   - Set booking date offset in days (future bookings)
   - Enable "Order Synchronization" toggle
   - Click "Save Settings"

4. **Test Connection**:
   - Click "Test Connection" button to verify credentials work
   - Should display your Rezgo company name on success

## Configuration

### Environment Variables (Optional)

Add to your `.env` file for additional control:

```env
# Rezgo API Configuration
REZGO_API_ENDPOINT=https://api.rezgo.com/index_json.php
REZGO_API_TIMEOUT=30

# Default Booking Settings
REZGO_PASSENGER_TYPE=Adult
REZGO_BOOKING_OFFSET=0

# Logging Configuration
REZGO_LOGGING_ENABLED=true
REZGO_DB_LOGGING=true

# Sync Settings
REZGO_SYNC_ENABLED=false
REZGO_AUTO_SUBMIT=true
```

### Admin Settings

All critical settings available in admin panel without code changes:

- **Rezgo CID**: Your Rezgo Company ID (encrypted)
- **API Key**: Your Rezgo API authentication key (encrypted)
- **Passenger Type**: Default category for orders (Adult/Child/Senior/etc)
- **Booking Date Offset**: Days to add to booking date (e.g., 2 = 2 days from now)
- **Enable Sync**: Toggle automatic order submission on/off
- **Test Connection**: Verify API credentials are valid
- **Sync Inventory**: Fetch latest available tours from Rezgo

## Usage

### Automatic Order Submission

Once configured and enabled:

1. Customer places order in Farmart
2. `OrderPlacedEvent` fires automatically
3. Plugin intercepts event in `SubmitOrderToRezgo` listener
4. Checks if sync is enabled and product is mapped
5. Extracts order data (passenger count, billing info)
6. Calls Rezgo API with booking commit instruction
7. Logs result to database and file
8. Updates order with Rezgo booking ID in metadata

### Manual Product Mapping

Some orders may use unmapped products. To map a product to a Rezgo tour:

1. Go to **Admin Panel → Rezgo Connector → Product Mappings**
2. Click "Add Mapping"
3. Select Farmart product from dropdown
4. Choose Rezgo tour from available list
5. Set passenger category (overrides default)
6. Click "Save Mapping"

Future orders for this product will automatically use the mapped tour.

### Monitoring Submissions

1. Go to **Admin Panel → Rezgo Connector → Order Submissions**
2. View all submitted orders with status badges
3. Click order ID to see detailed request/response data
4. Check HTTP status and Rezgo error messages if failed

### Viewing Activity Logs

1. Go to **Admin Panel → Rezgo Connector → Activity Logs**
2. See all sync operations, errors, and warnings
3. Filter by type: sync, error, warning, info
4. Related ID shows which order caused the log entry
5. Logs persist in both database and file: `/storage/logs/rezgo-sync.log`

## Database Schema

### rezgo_settings
| Column | Type | Notes |
|--------|------|-------|
| id | increments | Primary key |
| key | string | Setting key (rezgo_cid, rezgo_api_key, etc) |
| value | longText | Setting value (encrypted if sensitive) |
| is_encrypted | boolean | Whether value is encrypted |
| created_at | timestamp | |
| updated_at | timestamp | |

### rezgo_product_mappings
| Column | Type | Notes |
|--------|------|-------|
| id | increments | Primary key |
| product_id | bigintUnsigned | FK to ec_products |
| rezgo_uid | string | Rezgo tour unique identifier |
| rezgo_title | string | Tour name |
| passenger_type | string | Category (Adult, Child, etc) |
| is_active | boolean | Enable/disable mapping |
| created_at | timestamp | |
| updated_at | timestamp | |

### rezgo_submissions
| Column | Type | Notes |
|--------|------|-------|
| id | increments | Primary key |
| order_id | bigintUnsigned | FK to ec_orders |
| rezgo_booking_id | string | Returned trans_num from Rezgo |
| status | string | success, failed, pending |
| request_payload | json | Full request sent to API |
| response_payload | json | Full API response |
| http_status | integer | HTTP status code |
| error_message | text | Error details if failed |
| created_at | timestamp | |
| updated_at | timestamp | |

### rezgo_logs
| Column | Type | Notes |
|--------|------|-------|
| id | increments | Primary key |
| log_type | string | sync, error, warning, info |
| operation | string | Operation name (submit_order, sync_inventory) |
| message | text | Log message |
| related_id | bigintUnsigned | Related order/entity |
| context | json | Additional data |
| created_at | timestamp | |
| updated_at | timestamp | |

## File Structure

```
plugins/rezgo-connector/
├── plugin.json                          # Plugin manifest
├── config/
│   └── rezgo.php                        # Configuration defaults
├── src/
│   ├── Providers/
│   │   └── RezgoConnectorServiceProvider.php
│   ├── Models/
│   │   ├── RezgoSetting.php
│   │   ├── RezgoProductMapping.php
│   │   ├── RezgoSubmission.php
│   │   └── RezgoLog.php
│   ├── Services/
│   │   ├── RezgoApiService.php
│   │   ├── RezgoSettingsService.php
│   │   └── RezgoLoggerService.php
│   ├── Listeners/
│   │   └── SubmitOrderToRezgo.php
│   └── Http/
│       ├── Controllers/
│       │   └── RezgoConnectorController.php
│       └── Requests/
│           └── UpdateRezgoSettingsRequest.php
├── database/
│   └── migrations/
│       └── 2024_03_11_000000_create_rezgo_tables.php
├── routes/
│   └── web.php
└── resources/
    ├── lang/en/
    │   └── messages.php
    └── views/admin/
        ├── settings.blade.php
        ├── submissions.blade.php
        ├── submission-detail.blade.php
        ├── product-mappings.blade.php
        └── logs.blade.php
```

## API Reference

### RezgoApiService

**commitBooking(array $data): array**
```php
$response = $api->commitBooking([
    'book' => 'tour_uid',           // Rezgo tour UID
    'date' => '2024-12-25',         // YYYY-MM-DD format
    'tour_first_name' => 'John',    // Passenger first name
    'tour_last_name' => 'Doe',      // Passenger last name
    'customer_email' => 'john@...', // Contact email
    'customer_phone' => '555-1234',  // Contact phone
    'adult_num' => 2,                // Number of adults
    'child_num' => 1,                // Number of children
    'senior_num' => 0,               // Number of seniors
]);

// Returns:
// ['success' => true, 'status' => 200, 'data' => {...}, 'trans_num' => '12345678']
// ['success' => false, 'status' => 400, 'data' => {...}, 'error' => 'message']
```

**searchInventory(array $filters): array**
```php
$response = $api->searchInventory([
    'filter_type' => 'availability',
    'date_start' => '2024-12-01',
]);

// Returns array of available tours with: uid, title, description, pricing
```

**getCompanyInfo(): array**
```php
$company = $api->getCompanyInfo();
// Returns: ['company_name' => 'Company Name', 'logo_url' => '...', ...]
```

### RezgoSettingsService

```php
// Get encrypted setting
$cid = RezgoSettingsService::get('rezgo_cid');

// Set encrypted setting
RezgoSettingsService::set('rezgo_api_key', 'your-api-key');

// Helper methods
$isConfigured = RezgoSettingsService::isConfigured();
$passengerType = RezgoSettingsService::getDefaultPassengerType();
$offset = RezgoSettingsService::getBookingDateOffset();
$syncEnabled = RezgoSettingsService::isSyncEnabled();
```

### RezgoLoggerService

```php
// Log operations
RezgoLog::sync('operation_name', $relatedId, 'Message', $context);
RezgoLog::error('operation_name', $relatedId, 'Error message');
RezgoLog::warning('operation_name', $relatedId, 'Warning message');
RezgoLog::info('operation_name', $relatedId, 'Info message');

// Query logs
$logs = RezgoLog::whereLogType('error')->recent(10)->get();
```

## Troubleshooting

### Connection Failed Error
**Problem**: "Connection failed" when testing credentials
**Solution**: 
- Verify CID and API Key are correct
- Check Rezgo account is active
- Ensure server can reach https://api.rezgo.com
- Check firewall/proxy settings

### Orders Not Submitting
**Problem**: Orders placed but not in Rezgo
**Solution**:
- Verify sync is enabled in settings
- Check product is mapped to a Rezgo tour
- View Activity Logs for error messages
- Check HTTP status in submission detail

### 406 Error from Rezgo
**Problem**: "Not Acceptable" HTTP 406
**Solution**:
- Verify all required passenger counts are set
- Billing name/email must be provided
- Booking date must be in future
- Check passenger_type is valid for tour

### Missing Core Data Error
**Problem**: Rezgo API returns "Core data missing"
**Solution**:
- Ensure billing information is complete
- Passenger counts must match items quantity
- Booking date offset should be adequate
- Check order has valid customer email/phone

## Security Considerations

1. **Credential Encryption**: API key and CID encrypted in database using Laravel's encryption
2. **Logging**: Sensitive data never logged in plaintext
3. **HTTPS**: All API calls use HTTPS
4. **Database**: DB logs don't contain credentials
5. **File Logs**: File logs stored outside web root in `/storage/logs/`

## Performance Notes

- Database migrations are indexed for fast queries on log_type, operation, order_id
- Lazy loading prevents N+1 queries in admin lists
- API calls use 30-second timeout by default
- Submission history paginated at 50 per page

## Disabling the Plugin

If you need to disable the plugin:

```bash
php artisan plugin:deactivate rezgo-connector
```

This disables the event listener but preserves all data. Re-enable with:

```bash
php artisan plugin:activate rezgo-connector
```

## Support & Customization

To extend the plugin:

1. Create custom event listeners in your theme/plugin
2. Hook into `OrderPlacedEvent` after Rezgo submission
3. Use `RezgoSubmission::whereOrderId()` to check submission status
4. Extend `RezgoApiService` for additional Rezgo API endpoints

## License

This plugin is proprietary. All rights reserved.

## Changelog

### v1.0.0 (2024-03-11)
- Initial release
- Full Rezgo API integration
- Admin dashboard and configuration
- Activity logging and submission tracking
- Product-tour mapping system
- Encrypted credential storage
