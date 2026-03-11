<?php

namespace App\Providers;

use App\Listeners\SubmitOrderToRezgo;
use Botble\Ecommerce\Events\OrderPlacedEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        OrderPlacedEvent::class => [
            SubmitOrderToRezgo::class,
        ],
    ];
}
