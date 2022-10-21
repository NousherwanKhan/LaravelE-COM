<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'product_id',
        't_qty'
    ];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    
}

