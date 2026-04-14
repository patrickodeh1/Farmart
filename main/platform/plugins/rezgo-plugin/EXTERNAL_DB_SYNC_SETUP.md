# External Database Sync Setup Guide

## Overview

The Rezgo Connector plugin can synchronize ticket mappings and pricing to an external database in real-time. This is useful when you have a custom PHP application that needs access to your Farmart Rezgo inventory mappings.

## Prerequisites

- Access to your custom PHP app's MySQL database (same MySQL server as Farmart, different database)
- Database name, username, and password for the external database
- Ability to create tables in the external database

## Step 1: Create External Database Tables

The external database must have the following tables to receive synced data:

### ticket_mapping Table

```sql
CREATE TABLE ticket_mapping (
    rezgo_uid VARCHAR(255) PRIMARY KEY,
    ticket_name VARCHAR(255) NOT NULL,
    rezgo_price DECIMAL(10, 2) DEFAULT 0,
    available_dates JSON,
    synced_at TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### ticket_pricing Table (Optional)

```sql
CREATE TABLE ticket_pricing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rezgo_uid VARCHAR(255) NOT NULL,
    price_date DATE NOT NULL,
    current_price DECIMAL(10, 2),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_uid_date (rezgo_uid, price_date),
    FOREIGN KEY (rezgo_uid) REFERENCES ticket_mapping(rezgo_uid) ON DELETE CASCADE
);
```

### dates_availability Table (Optional)

```sql
CREATE TABLE dates_availability (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rezgo_uid VARCHAR(255) NOT NULL,
    available_date DATE NOT NULL,
    spots_available INT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_uid_date (rezgo_uid, available_date),
    FOREIGN KEY (rezgo_uid) REFERENCES ticket_mapping(rezgo_uid) ON DELETE CASCADE
);
```

## Step 2: Configure Environment Variables

Add the following to your Farmart `.env` file:

```env
# Enable external database sync
REZGO_EXTERNAL_SYNC_ENABLED=true

# External database connection details
REZGO_EXTERNAL_HOST=localhost          # Usually same as DB_HOST
REZGO_EXTERNAL_PORT=3306               # Usually same as DB_PORT
REZGO_EXTERNAL_USERNAME=your_username  # External DB username
REZGO_EXTERNAL_PASSWORD=your_password  # External DB password
REZGO_EXTERNAL_DATABASE=your_ext_db    # External database name

# Optional: Custom table names (if different from defaults)
REZGO_TICKET_MAPPING_TABLE=ticket_mapping
REZGO_TICKET_PRICING_TABLE=ticket_pricing
REZGO_DATES_AVAILABILITY_TABLE=dates_availability
```

## Step 3: Configure Database Connection (config/database.php)

Add an 'external' database connection to `config/database.php`:

```php
'external' => [
    'driver' => 'mysql',
    'host' => env('REZGO_EXTERNAL_HOST', env('DB_HOST')),
    'port' => env('REZGO_EXTERNAL_PORT', env('DB_PORT')),
    'database' => env('REZGO_EXTERNAL_DATABASE'),
    'username' => env('REZGO_EXTERNAL_USERNAME'),
    'password' => env('REZGO_EXTERNAL_PASSWORD'),
    'unix_socket' => env('DB_SOCKET', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
],
```

## Step 4: Restart Services

After updating the `.env` file, restart your Laravel services to reload the configuration:

```bash
# If using Docker
docker-compose restart

# Or manually clear config cache
php artisan config:cache
```

## How It Works

### When a mapping is saved:

1. Admin creates or edits a product-to-inventory mapping in the Rezgo Connector UI
2. The `saveProductMapping()` method saves the mapping locally to the Farmart database
3. If `REZGO_EXTERNAL_SYNC_ENABLED=true`, the `ExternalDatabaseSyncService` automatically syncs to the external database:
   - **Rezgo UID** is used as the primary key
   - **Ticket name** from the mapping is synced
   - **Price** information is synced
   - **Available dates** are fetched from Rezgo API and synced as JSON
   - **Sync timestamp** is recorded for audit purposes

### External database record example:

```json
{
  "rezgo_uid": "123456",
  "ticket_name": "Sunset Boat Tour",
  "rezgo_price": 49.99,
  "available_dates": [
    "2024-04-15",
    "2024-04-16",
    "2024-04-17"
  ],
  "synced_at": "2024-04-14 10:30:45",
  "updated_at": "2024-04-14 10:30:45"
}
```

## Monitoring Sync Status

All sync operations are logged in `storage/logs/rezgo.log` with the tag `external_sync`:

```bash
# View recent sync logs
tail -f storage/logs/rezgo.log | grep external_sync

# Or check via admin UI: Rezgo Connector → Logs
```

## Troubleshooting

### "Connection refused" error
- Verify the external database host, port, and credentials are correct
- Ensure the MySQL server is accessible from your Farmart server
- Check firewall rules if the external database is on a different server

### "table doesn't exist" error
- The external database tables haven't been created yet
- Run the SQL scripts from Step 1 in your external database
- Verify table names match your configuration in `.env`

### Sync not occurring
- Check if `REZGO_EXTERNAL_SYNC_ENABLED=true` in `.env`
- Review logs in `storage/logs/rezgo.log` for errors
- Verify the 'external' database connection is configured in `config/database.php`

### Incomplete mapping data
- The `available_dates` field is populated by calling the Rezgo API
- If dates are missing, check that your Rezgo API credentials are configured correctly
- Review logs for API errors under the `external_sync` log tag

## Security Considerations

1. **Credentials**: Store external database credentials in `.env`, never commit to git
2. **Access**: Limit external database access to necessary users and applications
3. **Network**: If the external database is on a different server, use VPN/private network
4. **Audit**: Monitor `storage/logs/rezgo.log` for unauthorized sync attempts

## Disabling External Sync

To temporarily disable sync without removing configuration:

```env
REZGO_EXTERNAL_SYNC_ENABLED=false
```

Mappings will still be saved locally in Farmart, but won't sync to the external database.

## Support

For issues or questions, review the logs or contact support with:
- Recent log entries from `storage/logs/rezgo.log`
- Database connection details (sanitized)
- Steps to reproduce the issue
