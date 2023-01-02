<?php

namespace App\Providers;

use App\Events\CustomerOrderPlaced;
use App\Events\UpdateOrderStatus;
use App\Events\VendorRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\CustomerOrderPlacedNotification;
use App\Listeners\SendVendorEmailVerificationNotification;
use App\Listeners\UpdateOrderStatusNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class           => [SendEmailVerificationNotification::class],
        VendorRegistered::class     => [SendVendorEmailVerificationNotification::class],
        UpdateOrderStatus::class    => [UpdateOrderStatusNotification::class],
        CustomerOrderPlaced::class  => [CustomerOrderPlacedNotification::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}