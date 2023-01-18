<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateExchangeRequestStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $exchangeRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($exchangeRequest)
    {
        $this->exchangeRequest = $exchangeRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.admin.update-exchange-request-status', ['exchangeRequest' => $this->exchangeRequest]);
    }
}