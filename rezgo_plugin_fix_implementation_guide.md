# Rezgo → Farmart Plugin Fix Implementation Guide

# Purpose

This document is written specifically so a smaller coding model (Claude Haiku, GPT mini models, junior dev, etc.) can implement the fixes without redesigning the system incorrectly.

DO NOT redesign the plugin.
DO NOT replace Farmart architecture.
DO NOT rewrite checkout.
DO NOT change database structure unless explicitly stated.

The goal is ONLY:

1. make dynamic pricing work
2. make import-as-draft work correctly
3. sync images/descriptions
4. support multi-item orders
5. support passenger-specific pricing
6. sync availability
7. queue heavy operations

---

# IMPORTANT IMPLEMENTATION RULES

## RULE 1

Keep all existing:

- admin pages
- routes
- mappings
- UI
- settings

Only improve backend logic.

---

## RULE 2

Do NOT remove:

```php
RezgoProductMapping
```

It is still required.

But it should become:

- mapping layer
NOT
- pricing source of truth

---

## RULE 3

Rezgo is the source of truth for:

- pricing
- availability
- booking data
- passenger pricing

Farmart is ONLY:

- storefront
- SEO/catalog
- draft management

---

# PART 1 — FIX DYNAMIC PRICING

# CURRENT PROBLEM

Current system stores pricing statically.

This is WRONG.

Rezgo pricing changes dynamically.

---

# REQUIRED FIX

Create:

```php
app/Services/RezgoPricingService.php
```

---

# FILE CONTENT

The service must:

1. Fetch pricing from Rezgo API
2. Resolve pricing by:
   - inventory
   - booking date
   - passenger type
3. Apply markup
4. Return final sell price

---

# REQUIRED METHODS

```php
class RezgoPricingService
{
    public function getLivePricing(
        string $rezgoUid,
        string $date,
        string $passengerType,
        int $quantity = 1
    )

    public function applyMarkup(float $basePrice, RezgoProductMapping $mapping)

    public function syncProductPrice(Product $product)
}
```

---

# IMPLEMENTATION NOTES

## getLivePricing()

Must:

1. Call Rezgo API
2. Fetch inventory pricing
3. Find correct passenger type
4. Return:

```php
[
    'base_price' => 100,
    'sell_price' => 120,
    'currency' => 'USD'
]
```

---

## applyMarkup()

Logic:

```php
if ($mapping->margin_percent) {
    $price += ($price * $mapping->margin_percent / 100);
}

if ($mapping->margin_amount) {
    $price += $mapping->margin_amount;
}
```

---

## syncProductPrice()

Must update Farmart product price.

```php
$product->price = $sellPrice;
$product->save();
```

---

# IMPORTANT

DO NOT use:

```php
mapping.sell_price
```

as source of truth anymore.

Only use live Rezgo pricing.

---

# PART 2 — FIX MULTI-ITEM ORDERS

# CURRENT PROBLEM

Code currently does:

```php
$firstItem = $order->items->first();
```

This breaks multi-product orders.

---

# REQUIRED FIX

In:

```php
SubmitOrderToRezgo.php
```

Replace:

```php
$firstItem = $order->items->first();
```

WITH:

```php
foreach ($order->items as $item)
```

---

# REQUIRED LOGIC

For EACH item:

1. Find mapping
2. Build Rezgo payload
3. Submit booking
4. Store response
5. Continue even if one item fails

---

# REQUIRED FAILURE HANDLING

DO NOT abort entire order because one item fails.

Use:

```php
try {
    // submit
} catch (\Exception $e) {
    Log::error(...);
    continue;
}
```

---

# PART 3 — FIX PASSENGER TYPE PRICING

# CURRENT PROBLEM

Code uses:

```php
$this->settings->getDefaultPassengerType()
```

for every product.

This is incorrect.

---

# REQUIRED FIX

Use:

```php
$mapping->passenger_type
```

FIRST.

Fallback ONLY if empty.

---

# REQUIRED LOGIC

```php
$passengerType =
    $mapping->passenger_type
    ?? $this->settings->getDefaultPassengerType();
```

---

# IMPORTANT

Passenger type affects pricing.

DO NOT hardcode:

```php
adult
```

for every booking.

---

# PART 4 — BUILD INVENTORY IMPORTER

# CURRENT PROBLEM

There is no real import pipeline.

---

# REQUIRED FIX

Create:

```php
app/Services/RezgoInventoryImporter.php
```

---

# RESPONSIBILITIES

Importer MUST:

1. Fetch inventories from Rezgo
2. Create draft products
3. Save descriptions
4. Save images
5. Save gallery
6. Create/update mappings
7. Store Rezgo metadata

---

# REQUIRED METHODS

```php
class RezgoInventoryImporter
{
    public function importInventory(array $inventory)

    public function createDraftProduct(array $normalized)

    public function syncImages(Product $product, array $images)

    public function syncDescription(Product $product, string $description)
}
```

---

# IMPORTANT

Importer MUST be idempotent.

Meaning:

If inventory already exists:

- update existing product
NOT
- create duplicates

---

# PART 5 — FIX IMAGE IMPORTING

# CURRENT PROBLEM

Direct image URLs are likely being saved.

Farmart/Botble media manager requires uploaded media.

---

# REQUIRED FIX

Use:

```php
RvMedia::downloadAndUploadImage()
```

---

# REQUIRED LOGIC

```php
$image = RvMedia::downloadAndUploadImage($url);

$product->image = $image;
```

---

# GALLERY SUPPORT

Loop all images.

Store gallery metadata correctly.

DO NOT store raw URLs.

---

# PART 6 — FIX DESCRIPTION IMPORTING

# CURRENT PROBLEM

Rezgo descriptions may be nested.

---

# REQUIRED FIX

Normalize all incoming Rezgo payloads.

---

# REQUIRED NORMALIZER

Create:

```php
app/Services/RezgoPayloadNormalizer.php
```

---

# REQUIRED METHOD

```php
public function normalizeInventory(array $inventory)
```

---

# RETURN FORMAT

Always return:

```php
[
    'title' => '',
    'description' => '',
    'images' => [],
    'price' => 0,
    'availability' => [],
    'uid' => ''
]
```

---

# IMPORTANT

Do NOT assume Rezgo fields are flat.

Always check nested keys safely.

Use:

```php
Arr::get($inventory, 'details.description')
```

NOT:

```php
$inventory['description']
```

---

# PART 7 — ADD AVAILABILITY SYNC

# CURRENT PROBLEM

Availability is not synchronized.

Users can purchase unavailable inventory.

---

# REQUIRED FIX

Create:

```php
app/Jobs/SyncRezgoAvailabilityJob.php
```

---

# JOB RESPONSIBILITIES

1. Fetch latest availability
2. Update product stock
3. Disable unavailable products
4. Cache date availability

---

# REQUIRED SCHEDULE

In:

```php
app/Console/Kernel.php
```

Add:

```php
$schedule->job(new SyncRezgoAvailabilityJob)
    ->everyThirtyMinutes();
```

---

# PART 8 — QUEUE ALL HEAVY OPERATIONS

# CURRENT PROBLEM

Everything runs inline.

This causes:

- slow checkout
- timeout risk
- image import failures
- blocking requests

---

# REQUIRED FIX

All these must become queued jobs:

1. inventory import
2. pricing sync
3. image downloads
4. availability sync
5. booking submission

---

# REQUIRED INTERFACE

All jobs must implement:

```php
ShouldQueue
```

---

# IMPORTANT

DO NOT perform:

- API calls
- image downloads
- large imports

inside controllers.

Controllers should ONLY dispatch jobs.

---

# PART 9 — CREATE REZGO INVENTORY CACHE TABLES

# CURRENT PROBLEM

Plugin depends too much on mappings.

Need local cache.

---

# REQUIRED TABLES

Create:

## rezgo_inventories

Fields:

```php
uid
name
status
base_price
currency
raw_payload
last_synced_at
```

---

## rezgo_inventory_dates

Fields:

```php
inventory_uid
booking_date
availability
price
```

---

## rezgo_inventory_images

Fields:

```php
inventory_uid
image_url
sort_order
```

---

# IMPORTANT

These tables are CACHE ONLY.

Rezgo remains source of truth.

---

# PART 10 — FIX BOOKING DATE LOGIC

# CURRENT PROBLEM

Current code:

```php
today + offset
```

This is incorrect.

---

# REQUIRED FIX

Booking date must come from:

- customer selection
OR
- product booking form

NOT generated automatically.

---

# REQUIRED SOURCE

Use order metadata or checkout form.

Example:

```php
$bookingDate = $order->meta_data['booking_date'];
```

---

# IMPORTANT

Pricing MUST use real booking date.

---

# PART 11 — CREATE CENTRAL REZGO API CLIENT

# REQUIRED FIX

Create:

```php
app/Services/RezgoApiClient.php
```

---

# RESPONSIBILITIES

ONLY this class should:

- make HTTP requests
- authenticate
- retry failures
- log requests
- parse responses

---

# REQUIRED METHODS

```php
getInventory()
getAvailability()
getPricing()
submitBooking()
```

---

# IMPORTANT

DO NOT scatter HTTP calls across the plugin.

ALL Rezgo API calls must go through this service.

---

# PART 12 — ADD RETRIES

# REQUIRED FIX

All API calls must retry.

Use:

```php
Http::retry(3, 1000)
```

---

# REQUIRED FAILURE LOGGING

Log:

- request payload
- response body
- status code
- inventory uid
- order id

---

# PART 13 — IMPORTANT THINGS NOT TO DO

# DO NOT

## DO NOT redesign Farmart products

Keep existing product model.

---

## DO NOT hardcode pricing

Pricing must always come from Rezgo.

---

## DO NOT save raw image URLs

Always use media manager.

---

## DO NOT block checkout with imports

Use queues.

---

## DO NOT use first order item only

Always iterate items.

---

## DO NOT assume flat Rezgo responses

Always normalize.

---

## DO NOT overwrite manual product edits

Only sync fields owned by Rezgo.

---

# PART 14 — SAFE IMPLEMENTATION ORDER

Implement EXACTLY in this order.

---

# STEP 1

Create:

```php
RezgoApiClient
```

---

# STEP 2

Create:

```php
RezgoPayloadNormalizer
```

---

# STEP 3

Create:

```php
RezgoPricingService
```

---

# STEP 4

Fix multi-item order support.

---

# STEP 5

Fix passenger type logic.

---

# STEP 6

Create inventory cache tables.

---

# STEP 7

Create inventory importer.

---

# STEP 8

Fix image importing.

---

# STEP 9

Fix description importing.

---

# STEP 10

Create availability sync job.

---

# STEP 11

Queue all heavy operations.

---

# FINAL RESULT EXPECTED

After implementation:

- products import correctly as drafts
- images sync correctly
- descriptions sync correctly
- pricing becomes dynamic
- passenger pricing works
- availability syncs correctly
- checkout handles multiple Rezgo products
- API failures become recoverable
- storefront prices remain updated
- imports no longer timeout

