<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
Use App\Pharmacist;

class verifyEmailToPharmacist extends Mailable
{
    use Queueable, SerializesModels;

    public $pharmacist;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pharmacist $pharmacist)
    {
        $this->pharmacist = $pharmacist;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.sendVerificationEmailToPharmacist');
    }
}
