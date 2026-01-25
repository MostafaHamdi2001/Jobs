<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * @var array<int, string>
     */
    protected $except = [
        'login',
        'api/login',
        'logout',
        'api/logout',
    ];

   
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('get')) {
            return parent::handle($request, $next);
        }

        foreach ($this->except as $except) {
            if ($request->fullUrlIs($except) || $request->is($except)) {
                return parent::handle($request, $next);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'عذراً، الموقع حالياً في وضع القراءة فقط. لا يمكن الإضافة أو التعديل.'
        ], 403);
    }
}