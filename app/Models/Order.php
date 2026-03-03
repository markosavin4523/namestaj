<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_number',
        'total_price',
        'user_id',
        'order_status_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }
    public function details(): HasOne
    {
        return $this->hasOne(OrderDetail::class);
    }
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'orders_products')
            ->withPivot('price', 'quantity')
            ->withTimestamps();
    }
}
