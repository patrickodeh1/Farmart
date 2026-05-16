{{-- Rezgo Calendar Modal Component --}}
<div id="rezgo-modal-{{ $uid }}" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:99999; overflow:hidden; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:8px; padding:24px; max-width:540px; width:90%; max-height:85vh; overflow-y:auto; position:relative; margin:auto;">
        <button type="button" id="rezgo-modal-close-{{ $uid }}" style="position:absolute; top:12px; right:16px; background:none; border:none; font-size:24px; cursor:pointer; line-height:1;">&times;</button>
        <h4 style="margin:0 0 16px;">Select Date &amp; Price</h4>

        <div class="rezgo-calendar" id="rezgo-calendar-{{ $uid }}" style="position:relative;">
            <div class="calendar-header">
                <button type="button" class="calendar-nav-prev">&larr; Previous</button>
                <h3 class="calendar-title">
                    <span class="calendar-month-name"></span>
                    <span class="calendar-year"></span>
                </h3>
                <button type="button" class="calendar-nav-next">Next &rarr;</button>
            </div>
            <div class="calendar-loading" style="display:none; position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.9); text-align:center; padding:40px; z-index:10;">Loading prices...</div>
            <table class="calendar-table" style="display:none; width:100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>
                    </tr>
                </thead>
                <tbody class="calendar-days"></tbody>
            </table>
            <div class="calendar-error-container"></div>
        </div>

        <div id="rezgo-selected-display-{{ $uid }}" style="display:none; margin-top:16px; padding:12px; background:#e8f5e9; border-radius:6px; border:1px solid #4caf50;">
            <strong>Selected:</strong>
            <span id="rezgo-display-date-{{ $uid }}"></span> &mdash;
            <span id="rezgo-display-price-{{ $uid }}" style="color:#2196f3; font-weight:600;"></span>
            <button type="button" id="rezgo-confirm-btn-{{ $uid }}" style="margin-left:12px; background:#4caf50; color:#fff; border:none; padding:6px 14px; border-radius:4px; cursor:pointer;">
                Confirm &amp; Close
            </button>
        </div>
    </div>
</div>

<style>
.rezgo-calendar { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
.calendar-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; }
.calendar-header button { background:#007bff; color:#fff; border:none; padding:7px 12px; border-radius:4px; cursor:pointer; font-size:13px; }
.calendar-header button:hover { background:#0056b3; }
.calendar-title { margin:0; font-size:17px; font-weight:600; }
.calendar-table th { background:#f5f5f5; padding:8px; text-align:center; font-weight:600; border-bottom:2px solid #ddd; font-size:12px; }
.calendar-table td { border:1px solid #eee; padding:6px; text-align:center; height:72px; vertical-align:top; }
.calendar-day { border-radius:4px; padding:4px; transition:all 0.15s; }
.calendar-day.available { background:#e8f5e9; border:1px solid #4caf50; cursor:pointer; }
.calendar-day.available:hover { background:#c8e6c9; transform:scale(1.04); }
.calendar-day.unavailable { background:#f5f5f5; color:#bbb; cursor:not-allowed; }
.calendar-day.selected { background:#4caf50 !important; color:#fff !important; font-weight:bold; }
.calendar-day.other-month { opacity:0.35; }
.calendar-date { font-weight:bold; display:block; font-size:15px; margin-bottom:2px; }
.calendar-price { font-size:11px; font-weight:600; color:#2196f3; display:block; }
.calendar-day.selected .calendar-price { color:#fff; }
.calendar-error { background:#ffebee; border:1px solid #f44336; color:#c62828; padding:10px; border-radius:4px; margin:8px 0; }
</style>

<script>
(function() {
    const uid = '{{ $uid }}';
    const modalEl  = document.getElementById('rezgo-modal-' + uid);
    const calendarEl = document.getElementById('rezgo-calendar-' + uid);
    const closeBtn   = document.getElementById('rezgo-modal-close-' + uid);
    const confirmBtn = document.getElementById('rezgo-confirm-btn-' + uid);
    const displayEl  = document.getElementById('rezgo-selected-display-' + uid);
    const displayDate  = document.getElementById('rezgo-display-date-' + uid);
    const displayPrice = document.getElementById('rezgo-display-price-' + uid);

    // Hidden form fields (in product-cart-form)
    const hiddenDate  = document.getElementById('rezgo-selected-date-' + uid);
    const hiddenPrice = document.getElementById('rezgo-selected-price-' + uid);

    let currentYear  = new Date().getFullYear();
    let currentMonth = new Date().getMonth() + 1;
    let pricingData  = {};
    let loaded       = false;
    let selectedDayEl = null;

    const monthNames = ['January','February','March','April','May','June',
                        'July','August','September','October','November','December'];

    // Open modal when Select Date button clicked
    const triggerBtn = document.getElementById('rezgo-select-date-btn-' + uid);
    if (triggerBtn) {
        triggerBtn.addEventListener('click', function() {
            document.body.appendChild(modalEl); modalEl.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            if (!loaded) { loadMonth(); loaded = true; }
        });
    }

    // Close modal
    function closeModal() {
        modalEl.style.display = 'none'; document.body.appendChild(modalEl);
        document.body.style.overflow = '';
    }

    closeBtn.addEventListener('click', closeModal);
    confirmBtn.addEventListener('click', closeModal);

    // Close on backdrop click
    modalEl.addEventListener('click', function(e) {
        if (e.target === modalEl) closeModal();
    });

    function loadMonth() {
        const loading = calendarEl.querySelector('.calendar-loading');
        const table   = calendarEl.querySelector('.calendar-table');
        const errBox  = calendarEl.querySelector('.calendar-error-container');
        errBox.innerHTML = '';
        loading.style.display = 'block';
        table.style.display   = 'none';

        fetch('/api/rezgo/pricing/month?uid=' + uid + '&year=' + currentYear + '&month=' + currentMonth)
            .then(function(res) { return res.json(); })
            .then(function(data) {
                loading.style.display = 'none';
                if (data.success && data.dates) {
                    pricingData = {};
                    data.dates.forEach(function(item) { pricingData[item.date] = item; });
                    renderCalendar();
                    table.style.display = 'table';
                } else {
                    throw new Error(data.error || 'Failed to load pricing');
                }
            })
            .catch(function(err) {
                loading.style.display = 'none';
                errBox.innerHTML = '<div class="calendar-error">Error loading calendar: ' + err.message + '</div>';
            });
    }

    function renderCalendar() {
        calendarEl.querySelector('.calendar-month-name').textContent = monthNames[currentMonth - 1];
        calendarEl.querySelector('.calendar-year').textContent = currentYear;

        const tbody = calendarEl.querySelector('.calendar-days');
        tbody.innerHTML = '';

        const firstDay      = new Date(currentYear, currentMonth - 1, 1).getDay();
        const daysInMonth   = new Date(currentYear, currentMonth, 0).getDate();
        const daysInPrevMonth = new Date(currentYear, currentMonth - 1, 0).getDate();
        const today         = new Date().toISOString().slice(0, 10);
        let day = 1;

        for (let i = 0; i < 6; i++) {
            const row = document.createElement('tr');
            for (let j = 0; j < 7; j++) {
                const cell   = document.createElement('td');
                const dayDiv = document.createElement('div');

                if (i === 0 && j < firstDay) {
                    const prevDay = daysInPrevMonth - firstDay + j + 1;
                    dayDiv.className = 'calendar-day other-month unavailable';
                    dayDiv.innerHTML = '<span class="calendar-date">' + prevDay + '</span>';
                } else if (day > daysInMonth) {
                    const nextDay = day - daysInMonth;
                    dayDiv.className = 'calendar-day other-month unavailable';
                    dayDiv.innerHTML = '<span class="calendar-date">' + nextDay + '</span>';
                    day++;
                } else {
                    const dateStr = currentYear + '-' + String(currentMonth).padStart(2,'0') + '-' + String(day).padStart(2,'0');
                    const pricing = pricingData[dateStr];
                    const isPast  = dateStr < today;

                    if (pricing && pricing.available && !isPast) {
                        dayDiv.className = 'calendar-day available';
                        dayDiv.innerHTML = '<span class="calendar-date">' + day + '</span>'
                            + '<span class="calendar-price">$' + pricing.price_adult.toFixed(2) + '</span>';
                        dayDiv.addEventListener('click', (function(ds, pr, el) {
                            return function() { selectDate(ds, pr, el); };
                        })(dateStr, pricing.price_adult, dayDiv));
                    } else {
                        dayDiv.className = 'calendar-day unavailable';
                        const priceHtml = (pricing && pricing.price_adult > 0 && !isPast)
                            ? '<span class="calendar-price">$' + pricing.price_adult.toFixed(2) + '</span>' : '';
                        dayDiv.innerHTML = '<span class="calendar-date">' + day + '</span>' + priceHtml;
                    }
                    cell.appendChild(dayDiv);
                    day++;
                }

                row.appendChild(cell);
            }
            // Skip empty trailing rows
            if (i === 0 || day <= daysInMonth + 1) tbody.appendChild(row);
        }
    }

    function selectDate(date, price, el) {
        // Clear previous selection
        if (selectedDayEl) selectedDayEl.classList.remove('selected');
        selectedDayEl = el;
        el.classList.add('selected');

        // Fill hidden fields
        if (hiddenDate)  hiddenDate.value  = date;
        if (hiddenPrice) hiddenPrice.value = price;

        // Show confirmation strip inside modal
        displayDate.textContent  = date;
        displayPrice.textContent = '$' + price.toFixed(2);
        displayEl.style.display  = 'block';

        // Update the trigger button text
        if (triggerBtn) triggerBtn.innerHTML = '<span class="ms-1">Date: ' + date + ' &mdash; $' + price.toFixed(2) + '</span>';
    }

    // Nav buttons (type=button so they never submit the form)
    calendarEl.querySelector('.calendar-nav-prev').addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 1) { currentMonth = 12; currentYear--; }
        loadMonth();
    });
    calendarEl.querySelector('.calendar-nav-next').addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 12) { currentMonth = 1; currentYear++; }
        loadMonth();
    });
    // Guard: intercept form submission if no date selected
    const cartForm = hiddenDate ? hiddenDate.closest("form") : null;
    if (cartForm) {
        cartForm.addEventListener("submit", function(e) {
            if (!hiddenDate.value) {
                e.preventDefault();
                e.stopImmediatePropagation();
                document.body.appendChild(modalEl);
                modalEl.style.display = "flex";
                document.body.style.overflow = "hidden";
                if (!loaded) { loadMonth(); loaded = true; }
            }
        }, true);
    }
})();
</script>
