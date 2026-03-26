<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',

    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'carts_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    public function totalPrice()
    {
        $total = 0;
        foreach ($this->products as $item) {
            $price = $item->prices()->first()->value ?? 0;
            $quantity = $item->pivot->quantity ?? 0;

            $total += $price * $quantity;
        }

        return $total;

    }
}
