<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;
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
