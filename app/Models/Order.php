<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const PENDING = '0';
    const DELIVERED = '1';

    protected $fillable = [
        'buyer_id',
        'fname',
        'lname',
        'email',
        'phone_number',
        'address',
        'city',
        'province',
        'pin_code',
        'payemnt_mode',
        'status',
        'message',
        'tracking_no'
    ];

    public function items(){
        return $this->hasMany(OrderItem::class);
    }
    public function buyer(){
        return $this->belongsTo(User::class, 'buyer_id');
    }
    // public function status(){
    //     return $this->hasOne(OrderItem::class)
    // }
}
