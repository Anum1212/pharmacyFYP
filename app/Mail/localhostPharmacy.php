<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class localhostPharmacy extends Mailable
{
    use Queueable, SerializesModels;

    public $pharmacistDetails;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pharmacistDetails)
    {
        $this->pharmacistDetails = $pharmacistDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.localHostPharmacy')
            ->to($this->pharmacistDetails->email)
            ->attach(public_path('/storage/myAssets/emailAttatchments/'. $this->pharmacistDetails->id .'.txt'));
    }
}
