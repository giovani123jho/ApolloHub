<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfMentor
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type === 'mentor' && $request->path() !== 'dashboard/mentor') {
            return redirect()->route('dashboard.mentor');
        }

        return $next($request);
    }
}
