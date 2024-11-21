<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MentorDashboardController extends Controller
{
    public function index()
    {
        // Obtém o mentor logado
        $mentor = auth()->user();

        // Retorna a view com os dados do mentor
        return view('dashboard.mentor', compact('mentor'));
    }
}
