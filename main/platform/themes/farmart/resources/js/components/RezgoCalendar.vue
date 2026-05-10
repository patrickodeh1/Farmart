<template>
  <div class="rezgo-calendar-container">
    <!-- Calendar Modal -->
    <div v-if="showModal" class="modal d-block" style="background-color: rgba(0,0,0,0.5)" @click.self="showModal = false">
      <div class="modal-dialog modal-lg" @click.stop>
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ modalTitle }}</h5>
            <button @click="showModal = false" type="button" class="btn-close"></button>
          </div>
          
          <div class="modal-body">
            <!-- Month/Year Navigation -->
            <div class="calendar-header mb-4">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <button type="button" @click.stop.prevent="previousMonth" class="btn btn-sm btn-outline-secondary">&larr; {{ __('Previous') }}</button>
                <h6 class="mb-0">{{ monthYearLabel }}</h6>
                <button type="button" @click.stop.prevent="nextMonth" class="btn btn-sm btn-outline-secondary">{{ __('Next') }} &rarr;</button>
              </div>
            </div>

            <!-- Days of Week Header -->
            <div class="calendar-weekdays mb-2">
              <div v-for="day in weekDays" :key="day" class="calendar-day-header">
                {{ day }}
              </div>
            </div>

            <!-- Calendar Grid -->
            <div class="calendar-grid">
              <!-- Empty cells for days before month starts -->
              <div
                v-for="i in firstDayOfMonth"
                :key="'empty-' + i"
                class="calendar-cell empty"
              ></div>

              <!-- Date cells -->
              <div
                v-for="day in daysInMonth"
                :key="day"
                @click="selectDate(day)"
                class="calendar-cell"
                :class="getCellClasses(day)"
              >
                <div class="date-number">{{ day }}</div>
                <div v-if="getPriceForDate(day)" class="price-tag">${{ getPriceForDate(day) }}</div>
                <div v-else class="price-tag unavailable">—</div>
              </div>
            </div>

            <!-- Legend -->
            <div class="calendar-legend mt-4 pt-3 border-top">
              <small class="text-muted">
                Click any date to view price and select. Green dates have available inventory.
              </small>
            </div>
          </div>

          <!-- Modal Footer - Hidden, auto-select on click -->
          <!-- Confirmation not needed - dates are selected directly -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'RezgoCalendar',
  props: {
    uid: {
      type: String,
      required: true,
    },
    buttonText: {
      type: String,
      default: 'Select Date & Price',
    },
    modalTitle: {
      type: String,
      default: 'Select your date & view pricing',
    },
  },
  data() {
    return {
      showModal: false,
      currentDate: new Date(),
      selectedDate: null,
      selectedPrice: null,
      tempSelectedDate: null,
      tempSelectedPrice: null,
      calendarDates: {},
      weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      loading: false,
    };
  },
  computed: {
    monthYearLabel() {
      return new Intl.DateTimeFormat('en-US', { month: 'long', year: 'numeric' }).format(this.currentDate);
    },
    selectedDateLabel() {
      if (!this.selectedDate) return '';
      return new Intl.DateTimeFormat('en-US', { weekday: 'long', month: 'short', day: 'numeric', year: 'numeric' }).format(new Date(this.selectedDate));
    },
    daysInMonth() {
      return new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 0).getDate();
    },
    firstDayOfMonth() {
      return new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), 1).getDay();
    },
  },
  mounted() {
    // Listen for the global event to open the modal
    if (window.rezgoEvents) {
      window.rezgoEvents.addEventListener('openCalendarModal', () => {
        this.showModal = true;
      });
    }
  },
  methods: {
    async loadCalendarDates() {
      if (this.loading) return;
      
      console.log('🔵 loadCalendarDates called, uid:', this.uid);
      this.loading = true;
      try {
        const params = {
          uid: this.uid,
          year: this.currentDate.getFullYear(),
          month: this.currentDate.getMonth() + 1,
        };
        console.log('📡 Fetching from /api/rezgo/pricing/month with params:', params);
        
        const response = await axios.get(`/api/rezgo/pricing/month`, { params });
        
        console.log('✅ API Response received:', response.data);

        if (response.data.success) {
          this.calendarDates = {};
          response.data.dates.forEach(dateObj => {
            this.calendarDates[dateObj.date] = {
              price_adult: dateObj.price_adult,
              available: dateObj.available,
            };
          });
          console.log('📊 Calendar dates loaded:', Object.keys(this.calendarDates).length, 'dates');
        }
      } catch (error) {
        console.error('❌ Failed to load calendar dates:', error);
        if (error.response) {
          console.error('Response status:', error.response.status);
          console.error('Response data:', error.response.data);
          console.error('Response headers:', error.response.headers);
        }
      } finally {
        this.loading = false;
      }
    },
    getPriceForDate(day) {
      const dateStr = this.getDateString(day);
      const dateData = this.calendarDates[dateStr];
      return dateData ? dateData.price_adult : null;
    },
    isDateAvailable(day) {
      const dateStr = this.getDateString(day);
      const dateData = this.calendarDates[dateStr];
      return dateData ? dateData.available : false;
    },
    getDateString(day) {
      const year = this.currentDate.getFullYear();
      const month = String(this.currentDate.getMonth() + 1).padStart(2, '0');
      const dayStr = String(day).padStart(2, '0');
      return `${year}-${month}-${dayStr}`;
    },
    getCellClasses(day) {
      const available = this.isDateAvailable(day);
      const dateStr = this.getDateString(day);
      // Check for selected (either selectedDate or tempSelectedDate during selection)
      const isSelected = this.selectedDate === dateStr || this.tempSelectedDate === dateStr;
      
      return {
        available: available,
        unavailable: !available,
        selected: isSelected,
        'cursor-pointer': available,
      };
    },
    selectDate(day) {
      if (!this.isDateAvailable(day)) return;
      
      const dateStr = this.getDateString(day);
      const price = this.getPriceForDate(day);
      
      // Directly select the date (no confirmation needed)
      this.selectedDate = dateStr;
      this.selectedPrice = price;
      this.tempSelectedDate = null;
      this.tempSelectedPrice = null;
      
      // Update hidden form fields immediately
      this.updateHiddenFields();
      
      // Emit event for parent component
      this.$emit('date-selected', {
        date: this.selectedDate,
        price: this.selectedPrice,
        uid: this.uid,
      });
      
      // Dispatch event to global event target so app.js can listen and update button
      if (window.rezgoEvents) {
        window.rezgoEvents.dispatchEvent(new CustomEvent('rezgoDateSelected', {
          detail: {
            date: this.selectedDate,
            price: this.selectedPrice,
            uid: this.uid,
          }
        }));
      }
      
      // Close the modal immediately after selection
      this.showModal = false;
      
      console.log('✅ Date selected directly:', { date: this.selectedDate, price: this.selectedPrice });
    },
    clearSelection() {
      this.selectedDate = null;
      this.selectedPrice = null;
      this.tempSelectedDate = null;
      this.tempSelectedPrice = null;
      this.$emit('date-cleared');
      this.updateHiddenFields();
    },
    previousMonth() {
      this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1, 1);
      this.loadCalendarDates();
    },
    nextMonth() {
      this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 1);
      this.loadCalendarDates();
    },
    updateHiddenFields() {
      // Update hidden form fields for cart submission
      const dateField = document.getElementById('rezgo-selected-date');
      const priceField = document.getElementById('rezgo-selected-price');
      const uidField = document.getElementById('rezgo-product-uid');
      
      if (dateField) dateField.value = this.selectedDate || '';
      if (priceField) priceField.value = this.selectedPrice || '';
      if (uidField) uidField.value = this.uid;
    },
  },
  watch: {
    showModal(newVal) {
      if (newVal) {
        this.loadCalendarDates();
      } else {
        // When modal closes without confirmation, clear temp selection
        this.tempSelectedDate = null;
        this.tempSelectedPrice = null;
      }
    },
  },
};
</script>

<style scoped>
.rezgo-calendar-container {
  padding: 15px 0;
}

.modal {
  display: flex;
  align-items: center;
  justify-content: center;
  position: fixed;
  z-index: 1050;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
}

.calendar-header {
  padding: 10px 0;
}

.calendar-weekdays {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 8px;
  margin-bottom: 10px;
}

.calendar-day-header {
  text-align: center;
  font-weight: 600;
  color: #666;
  padding: 8px;
  font-size: 0.85rem;
}

.calendar-grid {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 8px;
  margin: 20px 0;
}

.calendar-cell {
  aspect-ratio: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border: 2px solid #e0e0e0;
  border-radius: 6px;
  background: #f9f9f9;
  cursor: default;
  transition: all 0.2s ease;
  padding: 6px;
  min-height: 70px;
}

.calendar-cell.empty {
  background: transparent;
  border: none;
}

.calendar-cell.available {
  background: #e8f5e9;
  border-color: #4caf50;
  cursor: pointer;
}

.calendar-cell.available:hover {
  background: #c8e6c9;
  border-color: #388e3c;
  transform: translateY(-2px);
  box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);
}

.calendar-cell.available.selected {
  background: #4caf50;
  color: white;
  border-color: #2e7d32;
}

.calendar-cell.unavailable {
  background: #fafafa;
  border-color: #d0d0d0;
  color: #999;
}

.date-number {
  font-weight: 600;
  font-size: 1.1rem;
  line-height: 1;
  margin-bottom: 4px;
}

.price-tag {
  font-size: 0.85rem;
  font-weight: 600;
  color: #4caf50;
  margin-top: 4px;
}

.price-tag.unavailable {
  color: #ccc;
}

.calendar-legend {
  text-align: center;
}

.calendar-cell.selected .price-tag {
  color: white;
}

@media (max-width: 768px) {
  .calendar-grid {
    gap: 6px;
  }
  
  .calendar-cell {
    min-height: 60px;
    padding: 4px;
  }
  
  .date-number {
    font-size: 1rem;
  }
  
  .price-tag {
    font-size: 0.75rem;
  }
}
</style>
