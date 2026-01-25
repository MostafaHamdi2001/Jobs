<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromQuery, WithHeadings , WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Product::query()->with(['colors', 'photos']);
    }

    public function headings(): array
    {
        return [
            "رقم المنتج",
            "الاسم (عربي)",
            "Name (EN)",
            "الحالة",
            "الألوان المتاحة (Hex)",
            "عدد الصور",
            "تاريخ الإضافة"
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->title_ar,
            $product->title_en,
            $product->active,
            $product->colors->pluck('hex')->implode(', '),
            $product->photos->count(),
            $product->created_at->format('Y-m-d'),


        ];
    }
}
