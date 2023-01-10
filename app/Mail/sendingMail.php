<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emails;
    public function __construct($emails)
    {
        $this->emails = $emails;
    }

    public function build()
    {
        return $this->subject('Contact from system') // set the subject message
            ->view('email_template') // determine the view of mail
            ->with('emails', $this->emails); // pass the object email to var emails
    }
}
