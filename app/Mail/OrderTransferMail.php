<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderTransferMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param $data
     * @param $user
     */
    public function __construct($data, $user)
    {
        $this->data = $data;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->from('no-responder@tranfex.cl')
                ->subject('Orden ejecutada')
                ->view('emails.ordertransfer');
    }
}
