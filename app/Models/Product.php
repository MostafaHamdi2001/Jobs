<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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

    
}
