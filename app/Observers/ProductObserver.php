<?php
namespace App\Observers;

use App\Models\Product;
use App\Jobs\ProcessProductCreation;

class ProductObserver
{
    public function created(Product $product)
    {
        ProcessProductCreation::dispatch($product);
    }
}