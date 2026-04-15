# Rezgo Connector - Debug Instructions for Client

If you're experiencing issues with Rezgo Connector plugin, please follow these instructions to generate a debug report.

## Quick Start

### Option 1: Automatic Debug Script (Recommended)

Run this command from your Laravel root directory:

```bash
bash rezgo-debug.sh
```

This will automatically:
- Detect your deployment type (Docker or direct server)
- Run the Rezgo inventory debug command
- Collect PHP configuration info
- Test database connection
- Capture application logs
- Generate a report file

**Then send the generated `rezgo-debug-report-*.txt` file to support.**

---

## Manual Commands (If Script Doesn't Work)

### If you're using Docker

1. **Find your container name:**
   ```bash
   docker ps | grep app
   ```
   Look for a container name (e.g., `main_app_1`, `app`, `farmart_app`, etc.)

2. **Run debug command:**
   ```bash
   docker exec YOUR_CONTAINER_NAME php artisan rezgo:debug-inventory
   ```
   Replace `YOUR_CONTAINER_NAME` with the name from step 1

3. **Check logs:**
   ```bash
   docker exec YOUR_CONTAINER_NAME tail -100 /var/www/html/storage/logs/laravel.log
   ```

### If you're running Laravel directly on server

1. **Run debug command:**
   ```bash
   php artisan rezgo:debug-inventory
   ```

2. **Check logs:**
   ```bash
   tail -100 storage/logs/laravel.log
   ```

---

## What to Send to Support

Please provide:

1. **Output from the debug command** - Copy the entire output (all 12+ items listed)
2. **Application logs** - The contents of `storage/logs/laravel.log`
3. **PHP version:**
   ```bash
   php --version
   ```
4. **Your deployment method** - Tell us if you're using Docker or direct server deployment

---

## Interpreting Results

### Good Sign ✓
- Command shows 12 inventory items
- All items display: UID, name, option, duration, price
- No error messages

### Issue Indicators ✗
- Only 5 items showing (means API response not being parsed correctly)
- "Rezgo credentials not found" (API settings not configured)
- Database connection errors
- PHP version errors in logs

---

## Common Issues & Solutions

| Issue | Cause | Solution |
|-------|-------|----------|
| "Composer detected issues in your platform" | Wrong PHP version on host | Run commands via Docker (use `docker exec`) |
| Only 5 items showing | API response parsing error | Send debug output to support |
| "No such service" in Docker | Wrong container name | Run `docker ps` to find correct name |
| Permission denied error | Need sudo for Docker | Use `sudo docker exec ...` |

---

## Need Help?

1. Run the debug script or manual command
2. Collect the full output
3. Include your deployment details (Docker/direct server, PHP version)
4. Send all information to support

**Important:** Include the entire output, even if it shows errors. Errors help us diagnose the issue faster.
