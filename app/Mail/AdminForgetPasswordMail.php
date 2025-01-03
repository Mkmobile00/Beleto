<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminForgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $data;
    public function __construct($data)
    {
        $this->data=$data;
        
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Forget Password Mail')
        ->view('customerapi.forgotpasswordoptmail')
        ->with(['data' => $this->data]);
    }
}
