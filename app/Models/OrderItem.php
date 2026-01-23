<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'is_custom',
        'custom_notes',
        'bottle_size_id',
        'quantity',
        'price',
        'subtotal',
    ];

    protected $casts = [
        'custom_notes' => 'array',
        'is_custom' => 'boolean',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function bottleSize()
    {
        return $this->belongsTo(BottleSize::class);
    }
}
