<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Color;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductCreatedMail;

class ProductObserver
{
    public function created(Product $product)
    {
        // 1️⃣ ربط المنتج بكل الألوان الموجودة
        $colorIds = Color::pluck('id')->toArray();
        $product->colors()->sync($colorIds);

        // 2️⃣ إرسال إيميل
        Mail::to(config('mail.from.address'))
            ->send(new ProductCreatedMail($product));
    }
}
