<?php

namespace App\Listeners;

use App\Events\UpdateOrderStatus;
use App\Mail\Admin\UpdateOrderStatus as AdminUpdateOrderStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UpdateOrderStatusNotification
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
     * @param  \App\Events\UpdateOrderStatus  $event
     * @return void
     */
    public function handle(UpdateOrderStatus $event)
    {
        Mail::to($event->order->email)->send(new AdminUpdateOrderStatus($event->order));
    }
}