<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfCompany
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type === 'empresa' && $request->path() !== 'dashboard/company') {
            return redirect()->route('dashboard.company');
        }

        return $next($request);
    }
}
