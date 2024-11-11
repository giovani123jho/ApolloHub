<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importação da Facade Auth

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login'); // Certifique-se de que a view 'auth.login' existe
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Redireciona com base no tipo de usuário
            if ($user->user_type === 'empresa') {
                return redirect()->route('dashboard.company');
            } elseif ($user->user_type === 'mentor') {
                return redirect()->route('dashboard.mentor');
            }

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas']);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
