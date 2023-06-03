<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sales_order';

    protected $fillable = [
        'tax',
        'discount',
        'shipping',
        'supplier_id',
        'cashier_id',
        'status',
        'cash',
        'change',
        'subtotal'
    ];
}
