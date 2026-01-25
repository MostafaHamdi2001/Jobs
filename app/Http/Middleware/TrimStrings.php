<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
        
    ];

    public function handle($request, Closure $next)
    {
        if (!$request->isMethod('get')) {
            return response()->json([
                'error' => 'Read-Only Mode',
                'message' => 'مسموح فقط بطلبات العرض (GET). العمليات الأخرى معطلة.'
            ], 403);
        }

        return parent::handle($request, $next);
    }
}
