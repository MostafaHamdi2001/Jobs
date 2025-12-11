<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Http\Requests\ColorStoreRequest;
use App\Http\Requests\ColorUpdateRequest;

class ColorController extends Controller
{
    // عرض كل الألوان
    public function index()
    {
        return Color::latest()->get();
    }

    // إنشاء لون جديد
    public function store(ColorStoreRequest $request)
    {
        $color = Color::create($request->validated());

        return response()->json([
            'message' => 'Color created successfully',
            'data'    => $color
        ], 201);
    }

    // عرض لون واحد
    public function show(Color $color)
    {
        return response()->json([
            'data' => $color
        ]);
    }

    // تحديث لون
    public function update(ColorUpdateRequest $request, Color $color)
    {
        $color->update($request->validated());

        return response()->json([
            'message' => 'Color updated successfully',
            'data'    => $color
        ]);
    }

    // حذف لون
    public function destroy(Color $color)
    {
        $color->delete();

        return response()->json([
            'message' => 'Color deleted successfully',
        ]);
    }
}
