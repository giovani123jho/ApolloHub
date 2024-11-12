<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CompanyRedirectService
{
    public function __invoke($request, $next)
    {
        $companyId = Auth::id();

        if (!$this->hasAccess($companyId)) {
            return Redirect::route('no-access')->with('error', 'Acesso negado.');
        }

        return $next($request);
    }

    public function redirectToCompanyDashboard(int $companyId)
    {
        if (!$this->hasAccess($companyId)) {
            return Redirect::route('no-access')->with('error', 'Acesso negado.');
        }

        return Redirect::route('dashboard.company', ['id' => $companyId]);
    }

    public function hasAccess(int $companyId): bool
    {
        // Verifica se o usuário está autenticado e é uma empresa
        return Auth::check() && Auth::id() === $companyId && Auth::user()->user_type === 'empresa';
    }
}
