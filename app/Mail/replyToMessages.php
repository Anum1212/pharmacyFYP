<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class replyToMessages extends Mailable
{
    use Queueable, SerializesModels;

        public $recipientData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipientData)
    {
    $this->recipientData = $recipientData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $req)
    {
        return $this->from('anamamer0@gmail.com', 'Laravel Pharmacy Project')
      ->to($this->recipientData->senderEmail)
      ->subject('Reply from Pharmacy for : ' . $this->recipientData->name)
      ->view('email.replyToMessage',['reply'=>$req->message]);
    }
}
