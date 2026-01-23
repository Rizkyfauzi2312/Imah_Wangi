<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aroma extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'price',
    ];
}
