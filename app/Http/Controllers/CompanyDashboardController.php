<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mentorship;

class CompanyDashboardController extends Controller
{
    public function index()
    {
        // Carregar os mentores
        $mentors = User::where('user_type', 'mentor')
            ->select('id', 'name', 'description', 'profile_picture', 'linkedin_url')
            ->get();

        // Carregar as mentorias solicitadas pela empresa autenticada
        $mentorships = Mentorship::where('company_id', auth()->id())
            ->with('mentor') // Carregar dados do mentor relacionado
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.company', compact('mentors', 'mentorships'));
    }
}
