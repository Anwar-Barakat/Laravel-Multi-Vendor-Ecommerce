<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateReturnRequestStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $returnRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($returnRequest)
    {
        $this->returnRequest = $returnRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.admin.update-return-request-status', ['returnRequest' => $this->returnRequest]);
    }
}