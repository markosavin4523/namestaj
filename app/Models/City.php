<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
    ];
    public function users() : HasMany
    {
        return $this->hasMany(UserInfo::class);
    }
    public function orders() : HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
