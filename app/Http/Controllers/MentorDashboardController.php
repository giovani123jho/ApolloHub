<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentorship;

class MentorDashboardController extends Controller
{
    public function index()
    {
        // Obter o ID do mentor autenticado
        $mentorId = auth()->id();

        // Buscar as mentorias solicitadas para o mentor
        $mentorships = Mentorship::where('mentor_id', $mentorId)
            ->with('company') // Carregar os dados da empresa relacionada
            ->orderBy('created_at', 'desc')
            ->get();

        // Retornar a view com os dados
        return view('dashboard.mentor', compact('mentorships'));
    }
}

