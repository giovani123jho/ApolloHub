<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mentorship;

class CompanyDashboardController extends Controller
{
    /**
     * Exibe o dashboard da empresa com mentores e mentorias solicitadas.
     */
    public function index(Request $request)
    {
        // Parâmetros de filtro
        $search = $request->input('search'); // Captura o parâmetro de busca

        // Query para buscar mentores
        $mentorsQuery = User::where('user_type', 'mentor') // Apenas usuários do tipo 'mentor'
            ->select('id', 'name', 'description', 'profile_picture', 'linkedin_url', 'education'); // Seleciona os campos necessários

        // Filtro por nome ou formação
        if ($search) {
            $mentorsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%") // Busca por nome
                      ->orWhere('education', 'like', "%{$search}%"); // Busca por formação
            });
        }

        // Ordena e pagina os mentores
        $mentors = $mentorsQuery->orderBy('name', 'asc')->paginate(9);

        // Carregar mentorias solicitadas pela empresa autenticada
        $mentorships = Mentorship::where('company_id', auth()->id()) // Filtra pelas mentorias da empresa logada
            ->with(['mentor', 'detail']) // Carrega os relacionamentos com mentor e detalhes da mentoria
            ->orderBy('created_at', 'desc')
            ->get();

        // Retorna a view do dashboard da empresa
        return view('dashboard.company', compact('mentors', 'mentorships', 'search'));
    }
}
