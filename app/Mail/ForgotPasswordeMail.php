<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordeMail extends Mailable
{
  
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('User Verify Mail')
        ->view('customerapi.customerforgotpasswordoptmail')
        ->with(['data' => $this->data]);
    }
}
