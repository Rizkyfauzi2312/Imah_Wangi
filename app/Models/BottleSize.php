<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BottleSize extends Model
{
    protected $fillable = [
        'size_ml',
        'base_price',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
