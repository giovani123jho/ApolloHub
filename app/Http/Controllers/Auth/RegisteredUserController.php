<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validação dos dados de registro
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'in:mentor,empresa'], // Garante que o tipo de usuário seja válido
        ]);

        // Criação do novo usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type, // Define o tipo de usuário
        ]);

        // Dispara o evento de registro
        event(new Registered($user));

        // Autentica o usuário recém-criado
        Auth::login($user);

        // Redireciona com base no tipo de usuário
        return match ($user->user_type) {
            'mentor' => redirect()->route('dashboard.mentor'),
            'empresa' => redirect()->route('dashboard.company'),
            default => redirect()->route('dashboard'),
        };
    }
}
