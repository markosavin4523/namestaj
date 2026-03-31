<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dimension extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'width',
        'height',
        'depth',
    ];
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
