<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class customerOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $recipientData, $customerDetails, $products, $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipientData, $customerDetails, $products, $order)
    {
    $this->recipientData = $recipientData;
    $this->customerDetails = $customerDetails;
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
      ->view('email.customerOrder',['products'=>$this->products, 'customerDetails'=>$this->customerDetails]);
    }
}
