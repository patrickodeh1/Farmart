<?php

return [
    'rezgo' => [
        /**
         * Rezgo API Configuration
         */
        'api' => [
            'endpoint' => env('REZGO_API_ENDPOINT', 'https://api.rezgo.com/index_json.php'),
            'timeout' => env('REZGO_API_TIMEOUT', 30),
        ],

        /**
         * Default booking settings
         */
        'booking' => [
            'default_passenger_type' => env('REZGO_PASSENGER_TYPE', 'Adult'),
            'default_date_offset' => env('REZGO_BOOKING_OFFSET', 0),
        ],

        /**
         * Logging configuration
         */
        'logging' => [
            'enabled' => env('REZGO_LOGGING_ENABLED', true),
            'channel' => 'rezgo', // Requires channel in config/logging.php
            'database' => env('REZGO_DB_LOGGING', true),
        ],

        /**
         * Sync settings
         */
        'sync' => [
            'enabled' => env('REZGO_SYNC_ENABLED', false),
            'auto_submit_orders' => env('REZGO_AUTO_SUBMIT', true),
        ],
    ],
];
