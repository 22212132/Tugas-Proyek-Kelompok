<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 
        'status', 
        'payment_method', 
        'total_price', 
        'delivery_place',
    ];
    public function product()
    {  
        return $this->belongsTo(Product::class);
    }

}
