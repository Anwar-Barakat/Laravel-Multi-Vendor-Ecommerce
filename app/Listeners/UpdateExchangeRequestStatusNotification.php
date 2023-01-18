<?php

namespace App\Listeners;

use App\Events\ExchangeRequestStatus;
use App\Mail\Admin\UpdateExchangeRequestStatusMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UpdateExchangeRequestStatusNotification
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
     * @param  \App\Events\ExchangeRequestStatus  $event
     * @return void
     */
    public function handle(ExchangeRequestStatus $event)
    {
        Mail::to($event->exchangeRequest->order->email)->send(new UpdateExchangeRequestStatusMail($event->exchangeRequest));
    }
}