<!-- Rezgo Calendar Component -->
<div class="rezgo-calendar" id="rezgo-calendar-{{ $uid }}">
    <div class="calendar-header">
        <button class="calendar-nav-prev" data-month="-1">&larr; Previous</button>
        <h3 class="calendar-title">
            <span class="calendar-month-name">{{ $monthName ?? 'May' }}</span>
            <span class="calendar-year">{{ $year ?? date('Y') }}</span>
        </h3>
        <button class="calendar-nav-next" data-month="+1">Next &rarr;</button>
    </div>

    <div class="calendar-loading" style="display: none;">
        <p>Loading prices...</p>
    </div>

    <table class="calendar-table" style="display: none;">
        <thead>
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
        </thead>
        <tbody class="calendar-days">
            <!-- Days populated by JS -->
        </tbody>
    </table>
</div>

<style>
.rezgo-calendar {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    max-width: 500px;
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    gap: 10px;
}

.calendar-header button {
    background: #007bff;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}

.calendar-header button:hover {
    background: #0056b3;
}

.calendar-title {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.calendar-table {
    width: 100%;
    border-collapse: collapse;
}

.calendar-table th {
    background: #f5f5f5;
    padding: 10px;
    text-align: center;
    font-weight: 600;
    border-bottom: 2px solid #ddd;
    font-size: 12px;
}

.calendar-table td {
    border: 1px solid #eee;
    padding: 8px;
    text-align: center;
    height: 80px;
    vertical-align: top;
    position: relative;
}

.calendar-table td.other-month {
    background: #f9f9f9;
    color: #999;
}

.calendar-day {
    cursor: pointer;
    border-radius: 4px;
    padding: 4px;
    transition: all 0.2s;
}

.calendar-day.available {
    background: #e8f5e9;
    border: 1px solid #4caf50;
}

.calendar-day.available:hover {
    background: #c8e6c9;
    transform: scale(1.05);
}

.calendar-day.unavailable {
    background: #ffebee;
    border: 1px solid #f44336;
    color: #999;
    cursor: not-allowed;
}

.calendar-day.selected {
    background: #4caf50;
    color: white;
    font-weight: bold;
}

.calendar-date {
    font-weight: bold;
    display: block;
    font-size: 16px;
    margin-bottom: 2px;
}

.calendar-price {
    font-size: 12px;
    font-weight: 600;
    color: #2196f3;
    display: block;
}

.calendar-day.unavailable .calendar-price {
    color: #999;
}

.calendar-loading {
    text-align: center;
    padding: 40px 20px;
    color: #666;
}

.calendar-error {
    background: #ffebee;
    border: 1px solid #f44336;
    color: #c62828;
    padding: 12px;
    border-radius: 4px;
    margin: 10px 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('rezgo-calendar-{{ $uid }}');
    if (!calendarEl) return;

    const uid = '{{ $uid }}';
    const apiBaseUrl = '/api/rezgo';
    let currentYear = {{ $year ?? 'new Date().getFullYear()' }};
    let currentMonth = {{ $month ?? '(new Date().getMonth() + 1)' }};
    let pricingData = {};

    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'];

    function loadMonth() {
        const loading = calendarEl.querySelector('.calendar-loading');
        const table = calendarEl.querySelector('.calendar-table');
        
        loading.style.display = 'block';
        table.style.display = 'none';

        fetch(`${apiBaseUrl}/pricing/month?uid=${uid}&year=${currentYear}&month=${currentMonth}`)
            .then(res => res.json())
            .then(data => {
                if (data.success && data.dates) {
                    pricingData = {};
                    data.dates.forEach(item => {
                        pricingData[item.date] = item;
                    });
                    renderCalendar();
                    loading.style.display = 'none';
                    table.style.display = 'table';
                } else {
                    throw new Error(data.error || 'Failed to load pricing');
                }
            })
            .catch(err => {
                const error = document.createElement('div');
                error.className = 'calendar-error';
                error.textContent = 'Error loading calendar: ' + err.message;
                calendarEl.insertBefore(error, calendarEl.querySelector('.calendar-header').nextElementSibling);
                loading.style.display = 'none';
            });
    }

    function renderCalendar() {
        const titleMonth = calendarEl.querySelector('.calendar-month-name');
        const titleYear = calendarEl.querySelector('.calendar-year');
        titleMonth.textContent = monthNames[currentMonth - 1];
        titleYear.textContent = currentYear;

        const tbody = calendarEl.querySelector('.calendar-days');
        tbody.innerHTML = '';

        const firstDay = new Date(currentYear, currentMonth - 1, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth, 0).getDate();
        const daysInPrevMonth = new Date(currentYear, currentMonth - 1, 0).getDate();

        let day = 1;

        for (let i = 0; i < 6; i++) {
            const row = document.createElement('tr');

            for (let j = 0; j < 7; j++) {
                const cell = document.createElement('td');
                const dayDiv = document.createElement('div');

                if (i === 0 && j < firstDay) {
                    // Previous month
                    const prevDay = daysInPrevMonth - firstDay + j + 1;
                    dayDiv.className = 'calendar-day other-month';
                    dayDiv.innerHTML = `<span class="calendar-date">${prevDay}</span>`;
                    cell.appendChild(dayDiv);
                } else if (day > daysInMonth) {
                    // Next month
                    const nextDay = day - daysInMonth;
                    dayDiv.className = 'calendar-day other-month';
                    dayDiv.innerHTML = `<span class="calendar-date">${nextDay}</span>`;
                    cell.appendChild(dayDiv);
                    day++;
                } else {
                    // Current month
                    const dateStr = `${currentYear}-${String(currentMonth).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    const pricing = pricingData[dateStr];

                    if (pricing) {
                        dayDiv.className = pricing.available ? 'calendar-day available' : 'calendar-day unavailable';
                        dayDiv.innerHTML = `
                            <span class="calendar-date">${day}</span>
                            <span class="calendar-price">$${pricing.price_adult.toFixed(2)}</span>
                        `;
                        
                        if (pricing.available) {
                            dayDiv.addEventListener('click', function() {
                                selectDate(dateStr, pricing.price_adult);
                            });
                        }
                    } else {
                        dayDiv.className = 'calendar-day unavailable';
                        dayDiv.innerHTML = `<span class="calendar-date">${day}</span>`;
                    }

                    cell.appendChild(dayDiv);
                    day++;
                }

                row.appendChild(cell);
            }

            tbody.appendChild(row);
        }
    }

    function selectDate(date, price) {
        // Dispatch custom event so parent/document can handle selection
        const event = new CustomEvent('rezgo-date-selected', {
            detail: { uid, date, price },
            bubbles: true
        });
        
        // Dispatch on both calendar element and document for broader reach
        calendarEl.dispatchEvent(event);
        document.dispatchEvent(event);
        
        // Update UI - highlight selected date
        calendarEl.querySelectorAll('.calendar-day').forEach(el => el.classList.remove('selected'));
        event.target?.classList?.add?.('selected');
    }

    // Navigation
    calendarEl.querySelector('.calendar-nav-prev').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 1) {
            currentMonth = 12;
            currentYear--;
        }
        loadMonth();
    });

    calendarEl.querySelector('.calendar-nav-next').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 12) {
            currentMonth = 1;
            currentYear++;
        }
        loadMonth();
    });

    // Initial load
    loadMonth();
});
</script>
