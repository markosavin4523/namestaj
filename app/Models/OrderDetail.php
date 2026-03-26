<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable=[
        'first_name',
        'last_name',
        'phone',
        'address',
        'zip',
        'city_id',
        'order_id',
    ];
    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class);
    }

}
