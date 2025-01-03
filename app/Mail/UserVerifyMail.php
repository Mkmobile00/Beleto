<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserVerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('User Verify Mail')
        ->view('customerapi.customeroptmail')
        ->with(['user' => $this->user]);
    }
}
