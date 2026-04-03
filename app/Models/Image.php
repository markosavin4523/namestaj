<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $fillable=[
        'path',
        'alt',
        'is_primary',
        'product_id',
        'category_id',
    ];
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
