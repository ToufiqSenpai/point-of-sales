<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'name',
        'description',
        'barcode',
        'sku',
        'base_price',
        'selling_price',
        'weight',
        'sold',
        'stock',
        'category_id',
        'unit_id',
        'brand_id',
        'image_id'
    ];
}
