<?php

namespace App\Models;

use App\Models\SalesOrderItem;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function items(): HasMany
    {
        return $this->hasMany(SalesOrderItem::class, 'sales_order_id');
    }

    public function getInvIdAttribute(): string
    {
        return 'INV' . str_pad($this->attributes['id'], 9, '0', STR_PAD_LEFT);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'supplier_id');
    }
}
