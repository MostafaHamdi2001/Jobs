<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ProductFilter
{
    protected $request;
    protected $query;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($query)
    {
        $this->query = $query;

        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->query;
    }

    // الفلاتر المسموحة فقط
    public function filters()
    {
        return $this->request->only([
            'title',
            'active',
        ]);
    }

    // ████████ فلاتر المنتج ████████

    // فلتر البحث بالاسم
    public function title($value)
    {
        $this->query->where(function($q) use ($value) {
            $q->where('title_en', 'like', "%$value%")
              ->orWhere('title_ar', 'like', "%$value%");
        });
    }

    // فلتر حالة التفعيل
    public function active($value)
    {
        $this->query->where('active', $value);
    }
}
