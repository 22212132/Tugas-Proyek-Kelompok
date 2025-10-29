<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'name',
    'price',
    'stock',
    'description',
    'canteen_id',
    'image',
    ];

    public function canteen()
    {
        return $this->belongsTo(Canteen::class, 'canteen_id');
    }
}
