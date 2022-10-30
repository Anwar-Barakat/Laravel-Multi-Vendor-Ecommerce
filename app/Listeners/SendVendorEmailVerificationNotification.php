<?php

namespace App\Listeners;

use App\Events\VendorRegistered;
use App\Mail\VendorEmailVerification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVendorEmailVerificationNotification
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
     * @param  \App\Events\VendorRegistered  $event
     * @return void
     */
    public function handle(VendorRegistered $event)
    {
        Mail::to($event->vendor->email)->send(new VendorEmailVerification($event->vendor));
    }
}