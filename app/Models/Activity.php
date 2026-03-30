<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        "user",
        "date",
        "data",
        "query",
        "route",
    ];
}
