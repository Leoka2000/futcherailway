<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasUuids;
    protected $table = 'orders';


    protected $fillable = [
        'user_id',
        'name',
        'quantity',
        'status',
        'unit_price',
        'size',
        'session_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
