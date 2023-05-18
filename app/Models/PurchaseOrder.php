<?php

namespace App\Models;

use App\Models\PurchaseOrderProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'purchase_order';

    protected $fillable = [
        'tax',
        'discount',
        'shipping',
        'supplier_id',
        'status'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(PurchaseOrderProduct::class, 'purchase_order_id');
    }
}
