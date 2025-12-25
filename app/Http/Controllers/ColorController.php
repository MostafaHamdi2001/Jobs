<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Http\Requests\ColorStoreRequest;
use App\Http\Requests\ColorUpdateRequest;

class ColorController extends Controller
{
    // عرض صفحة الألوان
    public function index()
    {
        $colors = Color::latest()->get();
        return view('colors.index', compact('colors'));
    }

    // عرض نموذج إضافة لون جديد
    public function create()
    {
        return view('colors.create');
    }

    // تخزين لون جديد
    public function store(ColorStoreRequest $request)
    {
        Color::create($request->validated());
        return redirect()->route('colors.index')->with('success', 'Color created successfully');
    }

    // عرض نموذج تعديل اللون
    public function edit(Color $color)
    {
        return view('colors.edit', compact('color'));
    }

    // تحديث اللون
    public function update(ColorUpdateRequest $request, Color $color)
    {
        $color->update($request->validated());
        return redirect()->route('colors.index')->with('success', 'Color updated successfully');
    }

    // حذف اللون
    public function destroy(Color $color)
    {
        if($color->products()->exists()){
            return redirect()->back()->with("error","The color cannot be erased because it is linked to existing products. ");
        }
        $color->delete();
        return redirect()->route('colors.index')->with('success', 'Color deleted successfully');
    }
}
