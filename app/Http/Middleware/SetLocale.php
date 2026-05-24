<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('ja') || $request->is('ja/*')) {
            app()->setLocale('ja');
        } else {
            app()->setLocale('en');
        }

        return $next($request);
    }
}
