<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Filters\ProductFilter;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index(ProductFilter $filters)
    {
        $products = Product::query()->latest();
        $products = $filters->apply($products);

        return $products->get();
    }


    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json([
            'message' => 'Product created successfully',
            'data'    => $product
        ], 201);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->validated());
        
        return response()->json([
            'message' => 'Product updated successfully',
            'data'    => $product
        ]);
    }


    public function destroy($id)
    {
        $product = Product::withTrashed()->with('images')->findOrFail($id);

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $product->forceDelete(); 

        return response()->json([
            'message' => 'Product and its images permanently deleted',
        ]);
    }
}
