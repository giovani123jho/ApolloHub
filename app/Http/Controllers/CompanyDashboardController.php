<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CompanyDashboardController extends Controller
{
    public function index()
    {
        // Busca todos os usuários que têm 'user_type' definido como 'mentor'
        $mentors = User::where('user_type', 'mentor')->get();

        // Retorna a view do dashboard com os mentores
        return view('dashboard.company', compact('mentors'));
    }
}