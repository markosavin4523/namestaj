<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInfo extends Model
{
    use HasFactory;
    protected $fillable=[
        'phone',
        'address',
        'zip',
        'city_id',
        'user_id',
    ];
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
