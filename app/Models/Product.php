<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'quantity',
        'slug',
        'category_id',
        'discount',
        'user_id',
    ];
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function dimension(): HasOne
    {
        return $this->hasOne(Dimension::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'orders_products')
            ->withPivot('price', 'quantity')
            ->withTimestamps();
    }
    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class, 'carts_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
}
