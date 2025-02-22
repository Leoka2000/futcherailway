<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\RefundOrder;

class RefundOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $refundOrder;

    public function __construct(RefundOrder $refundOrder)
    {
        $this->refundOrder = $refundOrder;
    }

    public function build()
    {
        $this->from('noreply@futche.com', 'Futche')
            ->subject('Your Order Has Been Refunded')
            ->view('emails.refund_email')
            ->with([
                'orderID' => $this->refundOrder->order_hashed_id,
                'refundReason' => $this->refundOrder->refund_reason,
            ]);
    }
}
