<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentorship;
use App\Models\MentorshipDetail;
use App\Models\User;

class MentorshipController extends Controller
{
    /**
     * Solicitar mentoria.
     */
    public function request(Request $request, $mentorId)
    {
        $mentor = User::find($mentorId);

        if (!$mentor || $mentor->user_type !== 'mentor') {
            return redirect()->back()->with('error', 'Mentor inválido.');
        }

        $existingMentorship = Mentorship::where('mentor_id', $mentorId)
            ->where('company_id', auth()->id())
            ->where('status', 'pendente')
            ->first();

        if ($existingMentorship) {
            return redirect()->back()->with('error', 'Já existe uma solicitação de mentoria pendente para este mentor.');
        }

        Mentorship::create([
            'mentor_id' => $mentor->id,
            'company_id' => auth()->id(),
            'status' => 'pendente',
        ]);

        return redirect()->back()->with('success', 'Solicitação de mentoria enviada com sucesso!');
    }

    /**
     * Aceitar mentoria.
     */
    public function accept($id)
    {
        $mentorship = Mentorship::findOrFail($id);

        if ($mentorship->mentor_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Você não tem permissão para aceitar esta mentoria.');
        }

        $mentorship->status = 'aceita';
        $mentorship->save();

        // Redirecionar para o formulário de detalhes da mentoria
        return redirect()->route('mentorship.edit.details', $mentorship->id)
            ->with('success', 'Mentoria aceita! Preencha os detalhes da mentoria.');
    }

    /**
     * Recusar mentoria.
     */
    public function reject($id)
    {
        $mentorship = Mentorship::findOrFail($id);

        if ($mentorship->mentor_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Você não tem permissão para recusar esta mentoria.');
        }

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
                $query->select('id', 'name', 'email', 'whatsapp_number');
            }])
            ->get();

        return view('mentor.accepted-mentorships', compact('mentorships'));
    }

    /**
     * Exibir formulário para preencher os detalhes da mentoria.
     */
    public function editDetails($id)
    {
        $mentorship = Mentorship::with('detail')->findOrFail($id);

        if ($mentorship->mentor_id !== auth()->id()) {
            return redirect()->route('dashboard.mentor')->with('error', 'Você não tem permissão para acessar esta mentoria.');
        }

        return view('mentorships.edit-details', compact('mentorship'));
    }

    /**
     * Atualizar os detalhes da mentoria.
     */
    public function updateDetails(Request $request, $id)
    {
        $mentorship = Mentorship::findOrFail($id);

        if ($mentorship->mentor_id !== auth()->id()) {
            return redirect()->route('dashboard.mentor')->with('error', 'Você não tem permissão para atualizar esta mentoria.');
        }

        $validatedData = $request->validate([
            'content' => 'nullable|string|max:500',
            'mentoring_date' => 'required|date',
            'meeting_link' => 'nullable|url',
        ]);

        $mentorship->detail()->updateOrCreate(
            ['mentorship_id' => $mentorship->id],
            $validatedData
        );

        return redirect()->route('dashboard.mentor')->with('success', 'Detalhes da mentoria salvos com sucesso!');
    }
}
