<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->from('noreply@example.com', 'Your App Name') // Set the From address
            ->subject('Your Payment Has Been Approved')
            ->view('emails.payment_approved')
            ->with(['order' => $this->order]);
    }
}
