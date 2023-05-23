<?php

namespace App\Models;

use App\Models\PurchaseOrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

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
        return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id');
    }

    public function getInvIdAttribute(): string
    {
        return 'INV' . str_pad($this->attributes['id'], 9, '0', STR_PAD_LEFT);
    }
}
