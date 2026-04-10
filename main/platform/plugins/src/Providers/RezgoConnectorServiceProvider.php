<?php

namespace Botble\RezgoConnector\Providers;

use Illuminate\Support\ServiceProvider;
use Botble\Ecommerce\Events\OrderPlacedEvent;
use Botble\RezgoConnector\Listeners\SubmitOrderToRezgo;
use Illuminate\Support\Facades\Event;
use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\DashboardMenuItem;

class RezgoConnectorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register singleton services
        $this->app->singleton('rezgo.settings', function () {
            return new \Botble\RezgoConnector\Services\RezgoSettingsService();
        });

        $this->app->singleton('rezgo.api', function ($app) {
            return new \Botble\RezgoConnector\Services\RezgoApiService(
                $app->make(\Botble\RezgoConnector\Services\RezgoSettingsService::class)
            );
        });

        $this->app->singleton('rezgo.logger', function () {
            return new \Botble\RezgoConnector\Services\RezgoLoggerService();
        });
    }

    public function boot(): void
    {
        // Configure logging channel for Rezgo
        config(['logging.channels.rezgo' => [
            'driver' => 'daily',
            'path'   => storage_path('logs/rezgo-sync.log'),
            'level'  => 'debug',
            'days'   => 14,
        ]]);

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

        // Register admin menu
        DashboardMenu::default()->beforeRetrieving(function (): void {
            DashboardMenu::make()
                ->registerItem(
                    DashboardMenuItem::make()
                        ->id('rezgo-connector')
                        ->priority(50)
                        ->icon('ti ti-packages')
                        ->name('rezgo::messages.rezgo_connector')
                        ->route('rezgo.index')
                );
        });

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
