<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title_en',
        'title_ar',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];


    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
