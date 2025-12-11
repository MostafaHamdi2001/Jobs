<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    public function index()
    {
        return Product::latest()
            ->when(request()->has('active'), function ($query) {
                $query->where('active', request()->active);
            })
            ->get();
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        if (!isset($data['active'])) {
            $data['active'] = true;
        }
        $product = Product::create($data);

        return response()->json([
            'message' => 'Product created successfully',
            'data'    => $product
        ], 201);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        if (isset($data['title_en']) && str_contains(strtolower($data['title_en']), 'inactive')) {
            $data['active'] = false;
        } elseif (!isset($data['active'])) {
            $data['active'] = true;
        }

        $product->update($data);

        return response()->json([
            'message' => 'Product updated successfully',
            'data'    => $product
        ]);
    }

    
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }
}
