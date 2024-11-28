<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentorship;
use App\Models\User;

class MentorshipController extends Controller
{
    /**
     * Solicitar mentoria.
     */
    public function request(Request $request, $mentorId)
    {
        // Verificar se o mentor existe e se é do tipo 'mentor'
        $mentor = User::find($mentorId);

        if (!$mentor || $mentor->user_type !== 'mentor') {
            return redirect()->back()->with('error', 'Mentor inválido.');
        }

        // Verificar se já existe uma solicitação pendente entre a empresa e o mentor
        $existingMentorship = Mentorship::where('mentor_id', $mentorId)
            ->where('company_id', auth()->id())
            ->where('status', 'pendente')
            ->first();

        if ($existingMentorship) {
            return redirect()->back()->with('error', 'Já existe uma solicitação de mentoria pendente para este mentor.');
        }

        // Criar a solicitação de mentoria
        Mentorship::create([
            'mentor_id' => $mentor->id,
            'company_id' => auth()->id(), // ID da empresa autenticada
            'status' => 'pendente', // Status inicial da solicitação
        ]);

        return redirect()->back()->with('success', 'Solicitação de mentoria enviada com sucesso!');
    }

    /**
     * Aceitar mentoria.
     */
    public function accept($id)
    {
        $mentorship = Mentorship::findOrFail($id);

        // Verificar se o usuário autenticado é o mentor
        if ($mentorship->mentor_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Você não tem permissão para aceitar esta mentoria.');
        }

        // Atualizar o status para 'aceita'
        $mentorship->status = 'aceita';
        $mentorship->save();

        return redirect()->route('dashboard.mentor')->with('success', 'Mentoria aceita com sucesso!');
    }

    /**
     * Recusar mentoria.
     */
    public function reject($id)
    {
        $mentorship = Mentorship::findOrFail($id);

        // Verificar se o usuário autenticado é o mentor
        if ($mentorship->mentor_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Você não tem permissão para recusar esta mentoria.');
        }

        // Atualizar o status para 'recusada'
        $mentorship->status = 'recusada';
        $mentorship->save();

        return redirect()->back()->with('success', 'Mentoria recusada com sucesso!');
    }

    /**
     * Exibir todas as mentorias aceitas para o mentor.
     */
    public function acceptedMentorships()
    {
        $mentorId = auth()->id();

        $mentorships = Mentorship::where('mentor_id', $mentorId)
            ->where('status', 'aceita')
            ->with(['company' => function ($query) {
                $query->select('id', 'name', 'email', 'whatsapp'); // Certifique-se de incluir o campo WhatsApp
            }])
            ->get();

        return view('mentor.accepted-mentorships', compact('mentorships'));
    }
}
