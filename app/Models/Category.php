<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'parent_id',
        'slug',
    ];
    public function parent() : BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children() : HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function image() : HasOne
    {
        return $this->hasOne(Image::class);
    }

    public function getImagePathAttribute(){
        if (!$this->image) {
            return "images/default.png";
        }
        $path = $this->image->path;
        if (file_exists(public_path("storage/" . $path))) {
            return "storage/" . $path;
        }
        if (file_exists(public_path("images/categories/" . $path))) {
            return "images/categories/" . $path;
        }

        return "images/default.png";
    }


}
