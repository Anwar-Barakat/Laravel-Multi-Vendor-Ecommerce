<?php

namespace App\Listeners;

use App\Events\CustomerOrderPlaced;
use App\Mail\Admin\CustomerOrderPlaced as AdminCustomerOrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class CustomerOrderPlacedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CustomerOrderPlaced  $event
     * @return void
     */
    public function handle(CustomerOrderPlaced $event)
    {
        Mail::to($event->order->email)->send(new AdminCustomerOrderPlaced($event->order));
    }
}