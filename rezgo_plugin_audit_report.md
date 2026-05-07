# Rezgo → Farmart Plugin Audit

## High-Level Finding

Your current implementation is not actually doing “dynamic pricing”.

Right now the plugin behaves more like:

1. Map Farmart product → Rezgo UID
2. Submit order to Rezgo
3. Store logs/submissions

The pricing fields exist in the database model (`rezgo_price`, `cost_price`, `sell_price`, `margin_amount`, `margin_percent`) but there is no real synchronization or recalculation pipeline using them.

That is likely why:

- pricing becomes stale
- imported products do not reflect current Rezgo prices
- margin calculations are inconsistent
- draft imports are incomplete
- descriptions/images are missing or not updated

---

# Core Problems Found

## 1. Dynamic Pricing Is Not Implemented

File:
`RezgoProductMapping.php`

You defined:

```php
'rezgo_price',
'cost_price',
'sell_price',
'margin_amount',
'margin_percent',
```

But nowhere in the provided code do you:

- fetch live Rezgo pricing
- calculate markup/margin
- update Farmart product prices
- sync seasonal pricing
- handle date-based pricing
- handle passenger-type pricing
- cache pricing
- invalidate stale pricing

So the model supports pricing, but the business logic does not exist.

This is the biggest architectural gap.

---

# What Rezgo Actually Requires

Rezgo pricing is usually:

- inventory-based
- date-based
- passenger-type based
- availability-based
- option-based

Meaning:

- Adult price can differ from child price
- Weekend price can differ from weekday price
- Seasonal price can change daily
- Inventory-specific pricing can override defaults

Your current implementation:

```php
$passengerParams['adult_num'] = $totalPassengers;
```

Only sends passenger counts.

It does NOT:

- fetch passenger pricing
- compute totals from Rezgo
- map pricing tiers
- update Farmart pricing dynamically

So Farmart and Rezgo can easily go out of sync.

---

# 2. Wrong Mapping Strategy

File:
`SubmitOrderToRezgo.php`

You only use:

```php
$firstItem = $order->items->first();
```

This is dangerous.

Problems:

- multi-product orders break
- mixed Rezgo + non-Rezgo orders break
- only first item gets mapped
- pricing mismatches occur
- booking payload becomes inaccurate

Current logic:

```php
$mapping = RezgoProductMapping::getByProductId($firstItem->product_id);
```

This means:

- only ONE product is ever submitted
- other order items are ignored

That alone can completely break dynamic pricing calculations.

---

# 3. Passenger Type Logic Is Global Instead of Product-Specific

You have:

```php
$passengerType = $this->settings->getDefaultPassengerType();
```

But mappings already contain:

```php
'passenger_type'
```

Yet you never use:

```php
$mapping->passenger_type
```

Meaning:

- every product uses the same passenger type
- child/senior pricing can never work correctly
- dynamic pricing by ticket type is impossible

This is likely one of the reasons pricing behaves incorrectly.

---

# 4. Import-As-Draft Pipeline Is Missing Core Sync Logic

I do not see any:

- Rezgo inventory importer
- product creator service
- image downloader
- gallery attachment handler
- description sanitizer
- draft sync worker
- queue job
- update reconciliation

So your “import as draft” feature appears incomplete.

The provided code only covers:

- UI
- mapping
- submission
- settings

NOT actual inventory ingestion.

---

# 5. Description & Image Import Problem

The likely issue:

Rezgo descriptions/images are probably nested in API responses and not normalized before insertion into Farmart.

Common Rezgo response patterns:

```json
inventory.media.images
inventory.description
inventory.details.overview
```

If your importer assumes flat fields like:

```php
$product['description']
$product['image']
```

then imports silently fail.

Another common issue:

Botble/Farmart requires media attachment through its media manager.

Directly saving image URLs usually does NOT:

- generate thumbnails
- attach media properly
- register gallery images
- persist image metadata

You likely need:

```php
RvMedia::downloadAndUploadImage()
```

instead of storing raw URLs.

---

# 6. Pricing Fields Are Never Persisted Back to Products

I see no code updating:

```php
Product::update([
    'price' => ...
])
```

Meaning:

- Farmart frontend price remains static
- Rezgo pricing changes never reach storefront
- imported draft prices become stale immediately

This makes “dynamic pricing” impossible from the storefront perspective.

---

# 7. Missing Date-Aware Pricing

You currently do:

```php
$bookingDate = date('Y-m-d', strtotime("+{$bookingDateOffset} days"));
```

This is not true Rezgo pricing.

Rezgo pricing depends on:

- selected booking date
- inventory availability
- seasonal overrides
- ticket class

But your code simply generates:

```php
today + offset
```

So prices and availability will often mismatch.

---

# 8. Missing Availability Sync

You reference:

```php
'dates_availability_table'
```

in config.

But I see no:

- sync scheduler
- cron
- polling worker
- availability updater
- stock updater

Meaning:

- users can buy unavailable tours
- dynamic inventory states are never reflected

---

# 9. No Queueing = Sync Bottlenecks

Everything happens inline during:

```php
OrderPlacedEvent
```

This is risky because:

- Rezgo API latency blocks checkout
- failed requests affect UX
- imports can timeout
- image downloads can freeze requests

Your importer/sync should be queued.

You should use:

```php
ShouldQueue
```

with jobs like:

- SyncRezgoInventoryJob
- ImportRezgoProductJob
- SyncRezgoPricingJob
- SyncRezgoAvailabilityJob

---

# 10. Major Architectural Gap

You currently treat Rezgo like a simple product catalog.

Rezgo is actually:

- booking engine
- inventory engine
- pricing engine
- availability engine

Your architecture should revolve around:

## A. Inventory Sync Layer

Responsible for:

- inventories
- pricing
- dates
- ticket types
- availability
- images
- descriptions

## B. Farmart Product Layer

Responsible for:

- draft creation
- publishing
- SEO
- media
- categories

## C. Booking Layer

Responsible for:

- reservation submission
- booking confirmation
- retries
- reconciliation

Currently those concerns are mixed together.

---

# Most Likely Root Cause of Your Dynamic Pricing Problem

The actual root cause is probably this:

You are storing pricing statically inside mappings instead of calculating pricing dynamically from Rezgo inventory/date/passenger data.

This creates:

- stale pricing
- wrong totals
- mismatched bookings
- incorrect margins
- broken draft imports

---

# Recommended Fix Architecture

## Step 1 — Create Proper Inventory Sync Service

Create:

```php
RezgoInventorySyncService
```

Responsibilities:

- fetch inventories
- fetch pricing
- fetch availability
- fetch media
- fetch descriptions
- normalize Rezgo payloads

---

## Step 2 — Add Dedicated Product Importer

Create:

```php
RezgoProductImporter
```

Responsibilities:

- create/update draft products
- attach featured image
- attach gallery
- save description
- save metadata
- store Rezgo inventory IDs

---

## Step 3 — Dynamic Pricing Service

Create:

```php
RezgoPricingService
```

Responsibilities:

- resolve pricing by date
- passenger type pricing
- seasonal pricing
- markup calculation
- caching
- synchronization

Example:

```php
public function calculateSellPrice($inventory, $date, $passengerType)
```

---

## Step 4 — Stop Using First Order Item Only

Replace:

```php
$firstItem = $order->items->first();
```

with:

```php
foreach ($order->items as $item)
```

Then submit each mapped Rezgo inventory correctly.

---

## Step 5 — Use Mapping Passenger Type

Replace:

```php
$this->settings->getDefaultPassengerType()
```

with:

```php
$mapping->passenger_type
```

or fallback:

```php
$mapping->passenger_type ?? config default
```

---

## Step 6 — Queue Everything

Move:

- imports
- image downloads
- availability sync
- pricing sync
- booking submission

into queued jobs.

---

# Most Important Missing Feature

The biggest missing feature is:

## A persistent Rezgo inventory cache

You need local tables for:

- inventories
- ticket types
- availability dates
- pricing snapshots
- media

Right now everything appears mapping-driven instead of inventory-driven.

That is why dynamic pricing becomes difficult.

---

# Final Verdict

Your plugin foundation is decent:

- logging exists
- mappings exist
- submission flow exists
- admin UI exists
- config structure exists

But the implementation is still at “basic connector” stage.

The missing pieces are:

1. true inventory sync
2. dynamic pricing engine
3. media import pipeline
4. description normalization
5. queued architecture
6. availability synchronization
7. per-product passenger pricing
8. multi-item order support
9. Farmart price synchronization
10. draft product reconciliation

The core issue is architectural rather than a small bug.

You need a dedicated sync/import/pricing pipeline rather than embedding everything inside the order submission flow.

