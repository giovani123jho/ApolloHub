<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile (generic).
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Show the profile for companies.
     */
    public function showCompanyProfile()
    {
        $user = Auth::user();
        return view('profile.company', compact('user'));
    }

    /**
     * Show the profile for mentors.
     */
    public function showMentorProfile()
    {
        $user = Auth::user();
        return view('profile.mentor', compact('user'));
    }

    /**
     * Update the profile information (generic).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'education' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url',
            'description' => 'nullable|string|max:450',
            'whatsapp_number' => 'nullable|string|max:15', // Validação para o número de WhatsApp
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Atualizar a imagem de perfil
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Atualizar dados do usuário
        $user->name = $request->name;
        $user->email = $request->email;
        $user->education = $request->education;
        $user->linkedin_url = $request->linkedin_url;
        $user->description = $request->description;
        $user->whatsapp_number = $request->whatsapp_number; // Atualizar número de WhatsApp
        $user->save();

        // Redirecionar para o perfil correto
        if ($user->user_type === 'empresa') {
            return Redirect::route('profile.company')->with('success', 'Perfil atualizado com sucesso.');
        }

        if ($user->user_type === 'mentor') {
            return Redirect::route('profile.mentor')->with('success', 'Perfil atualizado com sucesso.');
        }

        return Redirect::route('profile.edit')->with('success', 'Perfil atualizado com sucesso.');
    }

    /**
     * Update additional company information.
     */
    public function updateCompanyProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'description' => 'nullable|string|max:450',
            'website' => 'nullable|url',
            'whatsapp_number' => 'nullable|string|max:15', // Validação para WhatsApp
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $user->profile_picture = $request->file('profile_picture')->store('logos', 'public');
        }

        $user->description = $request->description;
        $user->website = $request->website;
        $user->whatsapp_number = $request->whatsapp_number; // Atualizar número de WhatsApp
        $user->save();

        return Redirect::route('profile.company.edit')->with('success', 'Informações da empresa atualizadas com sucesso.');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return Redirect::route('profile.edit')->withErrors(['current_password' => 'A senha atual não está correta.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Senha atualizada com sucesso.');
    }

    /**
     * Delete the user's account (generic).
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        Auth::logout();

        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Conta deletada com sucesso.');
    }

    /**
     * Delete the company's account.
     */
    public function destroyCompanyProfile(Request $request)
    {
        $user = Auth::user();

        Auth::logout();

        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Conta da empresa deletada com sucesso.');
    }
}
