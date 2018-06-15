<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class customerOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $recipientData, $customerDetails, $product, $order, $orderItems;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipientData, $customerDetails, $product, $order, $orderItems)
    {
    $this->recipientData = $recipientData;
    $this->customerDetails = $customerDetails;
    $this->product = $product;
    $this->order = $order;
    $this->orderItems = $orderItems;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('anamamer0@gmail.com', 'Laravel Pharmacy Project')
      ->to($this->recipientData->email)
      ->subject('Order Invoice')
      ->view('email.customerOrder',['product'=>$this->product, 'customerDetails'=>$this->customerDetails]);
    }
}
