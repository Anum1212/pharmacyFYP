<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class invoice extends Mailable
{
    use Queueable, SerializesModels;

    public $recipientData, $products, $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipientData, $products, $order)
    {
        $this->recipientData = $recipientData;
        $this->products = $products;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('anamamer0@gmail.com', 'LifeLine')
            ->to($this->recipientData->email)
            ->subject('Order Invoice')
            ->view('email.invoice', ['product' => $this->products]);
    }
}
