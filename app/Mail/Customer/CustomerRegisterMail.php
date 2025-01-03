<?php

namespace App\Mail\Customer;

use App\Models\Customer\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerRegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $customer;
    /**
     * Create a new message instance.
     */
    public function __construct(Customer $customer)
    {
        $this->customer=$customer;
    }
/**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('OTP Verification')
        ->view('customerapi.customeroptmail')
        ->with('user', $this->customer);
    }
}
