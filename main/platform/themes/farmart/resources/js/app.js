/**
 * Farmart Theme - App Initialization
 * Registers Vue components and initializes theme functionality
 */

import { createApp } from 'vue'
import RezgoCalendar from './components/RezgoCalendar.vue'

// Create a global event target for inter-component communication
window.rezgoEvents = new EventTarget()

// Initialize function
function initializeRezgoCalendar() {
    const calendarRoot = document.getElementById('rezgo-calendar-root')
    
    if (calendarRoot) {
        const rezgoUid = calendarRoot.getAttribute('data-rezgo-uid')
        
        const app = createApp({
            components: {
                'rezgo-calendar': RezgoCalendar,
            },
            data() {
                return {
                    rezgoUid: rezgoUid,
                }
            },
            template: '<rezgo-calendar :uid="rezgoUid"></rezgo-calendar>'
        })
        
        // Make the i18n function available to all components
        app.config.globalProperties.__ = window.__ || ((key) => key)
        
        app.mount(calendarRoot)
        
        console.log('Rezgo Calendar initialized for UID:', rezgoUid)
        
        // Set up button click handler to open calendar modal
        const button = document.getElementById('rezgo-select-date-btn')
        if (button) {
            button.addEventListener('click', function(e) {
                e.preventDefault()
                // Dispatch a custom event that the component can listen to
                window.rezgoEvents.dispatchEvent(new CustomEvent('openCalendarModal'))
            })
        }
    }
}

// Listen for date selection event from the Vue component
if (window.rezgoEvents) {
    window.rezgoEvents.addEventListener('rezgoDateSelected', function(event) {
        const { date, price } = event.detail
        const button = document.getElementById('rezgo-select-date-btn')
        if (button) {
            // Format date for display (e.g., "May 18, 2026")
            const dateObj = new Date(date + 'T00:00:00')
            const formattedDate = new Intl.DateTimeFormat('en-US', { 
                month: 'short', 
                day: 'numeric', 
                year: 'numeric' 
            }).format(dateObj)
            
            // Update button text to show selection
            button.textContent = `✓ Selected: ${formattedDate} @ $${parseFloat(price).toFixed(2)}`
            button.classList.add('selected')
            button.classList.remove('btn-outline-primary')
            button.classList.add('btn-success')
            
            console.log('Button updated with selection:', { date, price })
        }
    })
}

// Initialize immediately if DOM is ready, or wait for DOMContentLoaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeRezgoCalendar)
} else {
    // DOM is already loaded, initialize immediately
    setTimeout(initializeRezgoCalendar, 0)
}


