<?php

namespace App\Providers;

use App\Events\ProductPriceWasChangedEvent;
use App\Events\ProductInCartEvent;
use App\Listeners\DetailPriceVariationListener;
use App\Listeners\SendMailToNewUserRegisteredListener;
use App\Listeners\UpdateProductStockListener;
use App\Listeners\StoreLastLoginDateListener;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
       ProductInCartEvent::class          => [
          UpdateProductStockListener::class,
        ],
       Registered::class                  => [
          SendMailToNewUserRegisteredListener::class,
       ],
       Login::class                       => [
          StoreLastLoginDateListener::class
       ],
       ProductPriceWasChangedEvent::class => [
          DetailPriceVariationListener::class
       ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
