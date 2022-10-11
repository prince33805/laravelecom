<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $table = 'products';

    protected $fillable = [
        'name',
        'product_price',
        'discount_price',
        'description',
        'product_quantity',
        'category',
        'image',
    ];
}
