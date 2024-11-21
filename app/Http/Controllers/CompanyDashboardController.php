<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CompanyDashboardController extends Controller
{
    /**
     * Exibe o dashboard da empresa com a lista de mentores.
     */
    public function index()
    {
        // Recupera mentores com paginação e descrição preenchida
        $mentors = User::where('user_type', 'mentor')
            ->whereNotNull('description') // Somente mentores com descrição
            ->paginate(10); // Paginação com 10 mentores por página

        return view('dashboard.company', compact('mentors'));
    }
}
