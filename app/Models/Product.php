<?php

namespace App\Models;

use Barryvdh\DomPDF\Facade\Pdf;
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

    protected $dates = ['deleted_at'];

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function exportPdf(){
        $products = Product::with('colors' , 'photos')->get();
        $pdf=Pdf::loadView('pdf.products_report',compact('products'));
        return $pdf->stream('products-list.pdf');

    }
}
