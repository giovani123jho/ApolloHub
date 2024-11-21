<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Buscar empresas e mentores
        $companies = User::where('user_type', 'empresa')
            ->select('name', 'description', 'profile_picture', 'website')
            ->get();

        $mentors = User::where('user_type', 'mentor')
            ->select('name', 'description', 'profile_picture', 'linkedin_url')
            ->get();

        // Passar as informações para a view
        return view('home', compact('companies', 'mentors'));
    }
}
