<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const PENDING = 'Pending';
    const APPROVED = 'Approved';
    const REJECTED = 'Rejected';

    protected $fillable = [
        'name',
        'descrption',
        'image',
        'price',
        'quantity',
        'buyer_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function scopeActive($query)
    {
        return $query->whereHas('user', function ($query) {
            $query->where('active', 1);
        });
    }
    // public function cart(){
    //     return $this->hasMany(Cart::class, 'product_id', 'id');
    // }
    // public function orders(){
    //     return $this->belongsTo(OrderItem::class, 'product_id','id');
    // }
}
