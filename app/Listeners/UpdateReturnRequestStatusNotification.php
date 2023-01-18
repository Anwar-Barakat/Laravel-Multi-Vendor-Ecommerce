<?php

namespace App\Listeners;

use App\Events\ReturnRequestStatus;
use App\Mail\Admin\UpdateReturnRequestStatusMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UpdateReturnRequestStatusNotification
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
     * @param  \App\Events\ReturnRequestStatus  $event
     * @return void
     */
    public function handle(ReturnRequestStatus $event)
    {
        Mail::to($event->returnRequest->order->email)->send(new UpdateReturnRequestStatusMail($event->returnRequest));
    }
}