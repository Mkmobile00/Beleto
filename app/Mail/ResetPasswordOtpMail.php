<?php

namespace App\Mail;

use App\Models\Customer\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $customer;
    protected $reset_otp;
    public function __construct(Customer $customer,$reset_otp)
    {
        $this->customer=$customer;
        $this->reset_otp=$reset_otp;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('OTP Verification')
        ->view('customerapi.customeroptmailreset')
        ->with('user', $this->customer)
        ->with('reset_otp', $this->reset_otp);
    }
}
