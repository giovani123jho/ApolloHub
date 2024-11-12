<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MentorRedirectService
{
    public function __invoke($request, $next)
    {
        $mentorId = Auth::id();

        if (!$this->hasAccess($mentorId)) {
            return Redirect::route('no-access')->with('error', 'Acesso negado.');
        }

        return $next($request);
    }

    public function redirectToMentorDashboard(int $mentorId)
    {
        if (!$this->hasAccess($mentorId)) {
            return Redirect::route('no-access')->with('error', 'Acesso negado.');
        }

        return Redirect::route('mentor.dashboard', ['id' => $mentorId]);
    }

    public function hasAccess(int $mentorId): bool
    {
        // Verifica se o usuário está autenticado e é um mentor
        return Auth::check() && Auth::id() === $mentorId && Auth::user()->user_type === 'mentor';
    }
}