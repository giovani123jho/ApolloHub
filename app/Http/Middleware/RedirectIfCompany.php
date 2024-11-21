<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfCompany
{
    public function handle($request, Closure $next)
    {
        // Verifica se o usuário está autenticado e é do tipo 'empresa'
        if (Auth::check() && Auth::user()->user_type === 'empresa') {
            // Bloqueia o acesso às páginas destinadas a mentores
            if ($request->path() === 'dashboard/mentor' || $request->path() === 'profile/mentor') {
                return redirect()->route('dashboard.company');
            }

            // Permite acesso ao dashboard da empresa e ao perfil da empresa
            if ($request->path() !== 'dashboard/company' && $request->path() !== 'profile/company') {
                return redirect()->route('dashboard.company');
            }
        }

        return $next($request);
    }
}
