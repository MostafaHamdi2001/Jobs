<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    // عرض صفحة المنتجات
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    // عرض نموذج إنشاء منتج
    public function create()
    {
        return view('products.create');
    }

    // تخزين منتج جديد
    public function store(ProductStoreRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    // عرض نموذج تعديل منتج
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // تحديث منتج
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // حذف منتج
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
