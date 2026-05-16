<?php
    Theme::layout('full-width');
    Theme::set('bodyClass', 'rezgo-tour-page');
?>

<div class="bg-light py-md-5 px-lg-3 px-2">
    <div class="container-xxxl">

        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('rezgo.storefront.tours')); ?>">Tours</a></li>
                <li class="breadcrumb-item active"><?php echo e($tour['title']); ?></li>
            </ol>
        </nav>

        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <div class="row">
            
            <div class="col-lg-7 mb-4">
                <?php if(!empty($tour['images'])): ?>
                    <img src="<?php echo e($tour['images'][0]); ?>" class="img-fluid rounded mb-3 w-100"
                         alt="<?php echo e($tour['title']); ?>" style="max-height:400px; object-fit:cover;">
                    <?php if(count($tour['images']) > 1): ?>
                        <div class="d-flex gap-2 flex-wrap">
                            <?php $__currentLoopData = array_slice($tour['images'], 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <img src="<?php echo e($img); ?>" class="rounded"
                                     style="height:80px; width:80px; object-fit:cover;" alt="">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if($tour['description']): ?>
                    <div class="mt-4 ck-content">
                        <?php echo $tour['description']; ?>

                    </div>
                <?php endif; ?>
            </div>

            
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4 sticky-top" style="top:20px;">
                    <h4 class="fw-bold mb-1"><?php echo e($tour['title']); ?></h4>
                    <?php if($tour['location']): ?>
                        <p class="text-muted small mb-3">
                            <i class="ti ti-map-pin"></i> <?php echo e($tour['location']); ?>

                        </p>
                    <?php endif; ?>

                    
                    <div id="rezgo-tour-calendar" class="mb-3"></div>

                    
                    <form action="<?php echo e(route('rezgo.storefront.cart.add')); ?>" method="POST" id="rezgo-booking-form">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="uid" value="<?php echo e($tour['uid']); ?>">
                        <input type="hidden" name="title" value="<?php echo e($tour['title']); ?>">
                        <input type="hidden" name="image" value="<?php echo e($tour['images'][0] ?? ''); ?>">
                        <input type="hidden" name="date" id="selected-date" value="">
                        <input type="hidden" name="price_adult" id="selected-price-adult" value="0">
                        <input type="hidden" name="price_child" id="selected-price-child" value="0">

                        <div id="booking-details" style="display:none;">
                            <div class="alert alert-success py-2 mb-3" id="selected-date-display"></div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Adults <span id="adult-price-label" class="text-muted fw-normal"></span></label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-secondary" onclick="changeQty('adult', -1)">-</button>
                                    <input type="number" name="qty_adult" id="qty-adult" class="form-control text-center" value="1" min="0" max="20">
                                    <button type="button" class="btn btn-outline-secondary" onclick="changeQty('adult', 1)">+</button>
                                </div>
                            </div>

                            <div class="mb-3" id="child-row" style="display:none;">
                                <label class="form-label fw-bold">Children <span id="child-price-label" class="text-muted fw-normal"></span></label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-secondary" onclick="changeQty('child', -1)">-</button>
                                    <input type="number" name="qty_child" id="qty-child" class="form-control text-center" value="0" min="0" max="20">
                                    <button type="button" class="btn btn-outline-secondary" onclick="changeQty('child', 1)">+</button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-bold">Total:</span>
                                <span class="fw-bold text-primary fs-5" id="booking-total">$0.00</span>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-lg">
                                <i class="ti ti-shopping-cart me-1"></i> Add to Cart
                            </button>
                        </div>

                        <div id="select-date-prompt" class="text-center text-muted py-3">
                            <i class="ti ti-calendar fs-2 d-block mb-2"></i>
                            Select a date above to see pricing and book
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="rezgo-calendar-modal-wrapper"></div>

<style>
.rezgo-calendar-inline { font-family: inherit; }
.rezgo-cal-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; }
.rezgo-cal-header button { background:#007bff; color:#fff; border:none; padding:6px 12px; border-radius:4px; cursor:pointer; }
.rezgo-cal-table { width:100%; border-collapse:collapse; }
.rezgo-cal-table th { background:#f5f5f5; padding:6px; text-align:center; font-size:11px; font-weight:600; border-bottom:2px solid #ddd; }
.rezgo-cal-table td { border:1px solid #eee; padding:4px; text-align:center; height:60px; vertical-align:top; }
.rezgo-cal-day { border-radius:4px; padding:2px; font-size:12px; }
.rezgo-cal-day.available { background:#e8f5e9; border:1px solid #4caf50; cursor:pointer; }
.rezgo-cal-day.available:hover { background:#c8e6c9; }
.rezgo-cal-day.unavailable { background:#f5f5f5; color:#bbb; }
.rezgo-cal-day.selected { background:#4caf50 !important; color:#fff !important; font-weight:bold; }
.rezgo-cal-day.other-month { opacity:0.3; }
.rezgo-cal-date { font-weight:bold; display:block; font-size:13px; }
.rezgo-cal-price { font-size:10px; color:#2196f3; display:block; }
.rezgo-cal-day.selected .rezgo-cal-price { color:#fff; }
.rezgo-cal-loading { text-align:center; padding:30px; color:#666; }
</style>

<script>
(function() {
    const uid = '<?php echo e($tour['uid']); ?>';
    let currentYear  = new Date().getFullYear();
    let currentMonth = new Date().getMonth() + 1;
    let pricingData  = {};
    let selectedDayEl = null;
    const monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];

    const calContainer = document.getElementById('rezgo-tour-calendar');
    const bookingDetails = document.getElementById('booking-details');
    const selectPrompt   = document.getElementById('select-date-prompt');
    const hiddenDate     = document.getElementById('selected-date');
    const hiddenAdult    = document.getElementById('selected-price-adult');
    const hiddenChild    = document.getElementById('selected-price-child');

    // Build calendar HTML
    calContainer.innerHTML = `
        <div class="rezgo-calendar-inline">
            <div class="rezgo-cal-header">
                <button type="button" id="rezgo-prev">&larr;</button>
                <strong id="rezgo-month-label"></strong>
                <button type="button" id="rezgo-next">&rarr;</button>
            </div>
            <div id="rezgo-cal-loading" class="rezgo-cal-loading">Loading prices...</div>
            <table class="rezgo-cal-table" id="rezgo-cal-table" style="display:none;">
                <thead><tr>
                    <th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>
                </tr></thead>
                <tbody id="rezgo-cal-body"></tbody>
            </table>
        </div>`;

    document.getElementById('rezgo-prev').addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 1) { currentMonth = 12; currentYear--; }
        loadMonth();
    });

    document.getElementById('rezgo-next').addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 12) { currentMonth = 1; currentYear++; }
        loadMonth();
    });

    function loadMonth() {
        const loading = document.getElementById('rezgo-cal-loading');
        const table   = document.getElementById('rezgo-cal-table');
        document.getElementById('rezgo-month-label').textContent = monthNames[currentMonth-1] + ' ' + currentYear;
        loading.style.display = 'block';
        table.style.display   = 'none';

        fetch('/api/rezgo/pricing/month?uid=' + uid + '&year=' + currentYear + '&month=' + currentMonth)
            .then(r => r.json())
            .then(data => {
                loading.style.display = 'none';
                if (data.success && data.dates) {
                    pricingData = {};
                    data.dates.forEach(d => { pricingData[d.date] = d; });
                    renderCalendar();
                    table.style.display = 'table';
                }
            })
            .catch(() => { loading.textContent = 'Failed to load pricing.'; });
    }

    function renderCalendar() {
        const tbody     = document.getElementById('rezgo-cal-body');
        tbody.innerHTML = '';
        const firstDay      = new Date(currentYear, currentMonth-1, 1).getDay();
        const daysInMonth   = new Date(currentYear, currentMonth, 0).getDate();
        const prevMonthDays = new Date(currentYear, currentMonth-1, 0).getDate();
        const today         = new Date().toISOString().slice(0,10);
        let day = 1;

        for (let i = 0; i < 6; i++) {
            const row = document.createElement('tr');
            for (let j = 0; j < 7; j++) {
                const cell   = document.createElement('td');
                const dayDiv = document.createElement('div');

                if (i === 0 && j < firstDay) {
                    dayDiv.className = 'rezgo-cal-day other-month';
                    dayDiv.innerHTML = '<span class="rezgo-cal-date">' + (prevMonthDays - firstDay + j + 1) + '</span>';
                } else if (day > daysInMonth) {
                    dayDiv.className = 'rezgo-cal-day other-month';
                    dayDiv.innerHTML = '<span class="rezgo-cal-date">' + (day - daysInMonth) + '</span>';
                    day++;
                } else {
                    const dateStr = currentYear + '-' + String(currentMonth).padStart(2,'0') + '-' + String(day).padStart(2,'0');
                    const pricing = pricingData[dateStr];
                    const isPast  = dateStr <= today;

                    if (pricing && pricing.available && !isPast) {
                        dayDiv.className = 'rezgo-cal-day available';
                        dayDiv.innerHTML = '<span class="rezgo-cal-date">' + day + '</span>'
                            + '<span class="rezgo-cal-price">$' + pricing.price_adult.toFixed(2) + '</span>';
                        dayDiv.addEventListener('click', (function(ds, pr, el) {
                            return function() { selectDate(ds, pr, el); };
                        })(dateStr, pricing, dayDiv));
                    } else {
                        dayDiv.className = 'rezgo-cal-day unavailable';
                        dayDiv.innerHTML = '<span class="rezgo-cal-date">' + day + '</span>';
                    }
                    cell.appendChild(dayDiv);
                    day++;
                }
                row.appendChild(cell);
            }
            if (i === 0 || day <= daysInMonth + 1) tbody.appendChild(row);
        }
    }

    function selectDate(date, pricing, el) {
        if (selectedDayEl) selectedDayEl.classList.remove('selected');
        selectedDayEl = el;
        el.classList.add('selected');

        hiddenDate.value  = date;
        hiddenAdult.value = pricing.price_adult;
        hiddenChild.value = pricing.price_child;

        document.getElementById('adult-price-label').textContent = '($' + pricing.price_adult.toFixed(2) + ' each)';

        const childRow = document.getElementById('child-row');
        if (pricing.price_child > 0) {
            document.getElementById('child-price-label').textContent = '($' + pricing.price_child.toFixed(2) + ' each)';
            childRow.style.display = 'block';
        } else {
            childRow.style.display = 'none';
        }

        document.getElementById('selected-date-display').textContent = 'Selected: ' + date + ' — from $' + pricing.price_adult.toFixed(2);
        bookingDetails.style.display = 'block';
        selectPrompt.style.display   = 'none';
        updateTotal();
    }

    window.changeQty = function(type, delta) {
        const input = document.getElementById('qty-' + type);
        const val   = Math.max(0, parseInt(input.value || 0) + delta);
        input.value = val;
        updateTotal();
    };

    function updateTotal() {
        const priceAdult = parseFloat(hiddenAdult.value || 0);
        const priceChild = parseFloat(hiddenChild.value || 0);
        const qtyAdult   = parseInt(document.getElementById('qty-adult').value || 0);
        const qtyChild   = parseInt(document.getElementById('qty-child').value || 0);
        const total      = (priceAdult * qtyAdult) + (priceChild * qtyChild);
        document.getElementById('booking-total').textContent = '$' + total.toFixed(2);
    }

    document.getElementById('rezgo-booking-form').addEventListener('submit', function(e) {
        if (!hiddenDate.value) {
            e.preventDefault();
            alert('Please select a date first.');
            return;
        }
        const qtyAdult = parseInt(document.getElementById('qty-adult').value || 0);
        const qtyChild = parseInt(document.getElementById('qty-child').value || 0);
        if (qtyAdult + qtyChild < 1) {
            e.preventDefault();
            alert('Please select at least 1 ticket.');
        }
    });

    loadMonth();
})();
</script>
<?php /**PATH /var/www/html/platform/plugins/rezgo-plugin/src/Providers/../../resources/views/themes/tour.blade.php ENDPATH**/ ?>