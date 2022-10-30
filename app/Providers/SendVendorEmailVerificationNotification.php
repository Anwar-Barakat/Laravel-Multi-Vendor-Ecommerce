<?php

namespace App\Providers;

use App\Providers\VendorRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
     * @param  \App\Providers\VendorRegistered  $event
     * @return void
     */
    public function handle(VendorRegistered $event)
    {
        //
    }
}
