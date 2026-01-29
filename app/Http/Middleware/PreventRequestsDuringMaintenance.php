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
        'api/login',
        'api/logout',
    ];

    
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('get')) {
            return $next($request);
        }

        foreach ($this->except as $except) {
            if ($request->is($except)) {
                return $next($request);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'عذراً، الموقع حالياً في وضع القراءة فقط. لا يمكن الإضافة أو التعديل.'
        ], 403);
    }
}