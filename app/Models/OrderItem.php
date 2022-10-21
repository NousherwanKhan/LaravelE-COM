<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    // const PENDING = 'Pending';
    // const DELIVERED = 'Delivered';

    protected $fillable = [
        'order_id',
        'buyer_id',
        'product_id',
        'quantity',
        'price',
        'payment_status'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
