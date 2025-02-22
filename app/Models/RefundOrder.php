<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefundOrder extends Model
{
    protected $fillable = [
        'order_hashed_id',
        'email',
        'status',
        'refund_reason',
        'session_id',
        'refund_pix_key',
    ];
}
