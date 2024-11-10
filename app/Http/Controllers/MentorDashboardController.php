<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MentorDashboardController extends Controller
{
    public function index()
    {
        // Aqui você pode buscar as empresas ou qualquer dado relevante para o mentor
        // Por exemplo, você poderia buscar todas as empresas
        // $companies = Company::all();

        return view('dashboard.mentor'); // Carrega a view do dashboard do mentor
    }
}
