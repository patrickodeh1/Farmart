<?php

namespace Botble\RezgoConnector\Providers;

use Botble\Core\Supports\ServiceProvider;
use Botble\Ecommerce\Events\OrderPlacedEvent;
use Botble\RezgoConnector\Listeners\SubmitOrderToRezgo;
use Illuminate\Support\Facades\Event;

class RezgoConnectorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register singleton services
        $this->app->singleton('rezgo.settings', function () {
            return new \Botble\RezgoConnector\Services\RezgoSettingsService();
        });

        $this->app->singleton('rezgo.api', function () {
            return new \Botble\RezgoConnector\Services\RezgoApiService();
        });

        $this->app->singleton('rezgo.logger', function () {
            return new \Botble\RezgoConnector\Services\RezgoLoggerService();
        });
    }

    public function boot(): void
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        // Load translations
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'rezgo');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'rezgo');

        // Register event listener
        Event::listen(OrderPlacedEvent::class, SubmitOrderToRezgo::class);

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Botble\RezgoConnector\Commands\SetupRezgoTestData::class,
            ]);
        }

        // Publish configuration
        $this->publishes(
            [__DIR__ . '/../../config' => config_path('rezgo')],
            'rezgo-config'
        );
    }
}
