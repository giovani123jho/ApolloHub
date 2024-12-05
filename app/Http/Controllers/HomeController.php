<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SymplaService;

class HomeController extends Controller
{
    public function index(SymplaService $symplaService)
    {
        // Buscar empresas incubadas, ordenadas alfabeticamente
        $companies = User::where('user_type', 'empresa')
            ->select('name', 'description', 'profile_picture', 'website')
            ->orderBy('name', 'asc') // Ordena alfabeticamente
            ->get();

        // Buscar eventos do Sympla
        $eventsResponse = $symplaService->getEvents();

        // Verificar se houve erro ao buscar eventos
        if (isset($eventsResponse['error']) && $eventsResponse['error'] === true) {
            $events = []; // Array vazio caso haja erro
            $eventsError = $eventsResponse['message'] ?? 'Erro ao buscar eventos do Sympla.';
        } else {
            $events = $eventsResponse; // Caso não haja erro, use os eventos retornados
            $eventsError = null; // Sem erro
        }

        // Passar empresas, eventos e mensagem de erro para a view
        return view('home', compact('companies', 'events', 'eventsError'));
    }
}
