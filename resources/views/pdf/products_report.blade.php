<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; text-align: right; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: center; }
        .color-circle {
            display: inline-block; width: 15px; height: 15px;
            border-radius: 50%; border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h2>قائمة منتجات المشروع</h2>
    <table>
        <thead>
            <tr>
                <th>الاسم (AR)</th>
                <th>الحالة</th>
                <th>الألوان</th>
                <th>عدد الصور</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->title_ar }}</td>
                <td style="color: {{ $product->active ? 'green' : 'red' }}">
                    {{ $product->active ? 'مفعل' : 'معطل' }}
                </td>
                <td>
                    @foreach($product->colors as $color)
                        <span class="color-circle" style="background-color: {{ $color->hex }}"></span>
                    @endforeach
                </td>
                <td>{{ $product->photos->count() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>