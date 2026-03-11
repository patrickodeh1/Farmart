# Quick Setup Commands - Copy & Paste to Your VPS

## 1️⃣ SSH into your VPS

```bash
ssh root@173.212.248.146
```

## 2️⃣ Navigate to Farmart root directory

```bash
cd /var/www/html
```

## 3️⃣ Run the standalone test data setup script

```bash
php setup_rezgo_test_data.php
```

This will:
- ✅ Update existing "John Doe" submission to "Dreamzone Test"
- ✅ Create 10 Farmart test products (5 Universal + 5 Disney)
- ✅ Create test customer "Dreamzone Test"
- ✅ Create 10 test orders ready for integration

## 4️⃣ Verify test data was created

```bash
# Check if orders were created
php -r "
require 'main/vendor/autoload.php';
\$app = require 'main/bootstrap/app.php';
\$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
\$count = \Botble\Ecommerce\Models\Order::where('code', 'like', 'REZTEST%')->count();
echo \"Test orders created: \$count\\n\";
"
```

## 5️⃣ Review in Farmart Admin

Go to: `http://173.212.248.146:8002/admin`

- **Orders**: Should see 10 orders with codes like REZTEST*
- **Products**: Should see 10 new products (5 Universal + 5 Disney)
- **Customers**: Should see "Dreamzone Test" (test@dreamzone.com)

## 6️⃣ Ready for Plugin Installation

Test data is now prepared. When you're ready:

1. Install the Rezgo plugin via the plugin installer
2. Run plugin migrations
3. Configure Rezgo API credentials (CID + API Key)
4. Plugin will automatically submit these test orders to Rezgo

---

**Expected Result:** 10 test orders ready to be submitted to Rezgo with "Dreamzone Test" as the customer name visible in both Farmart and (after plugin activation) Rezgo backend.
