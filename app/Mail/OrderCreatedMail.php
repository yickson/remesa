<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
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
                ->cc('estefanidrj@gmail.com', 'Estefani Rodriguez')
                ->cc('reinier.ramirez72@gmail.com', 'Reinier Ramírez')
                ->subject('Orden creada')
                ->view('emails.ordercreated');
    }
}
