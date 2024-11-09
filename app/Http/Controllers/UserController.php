<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|string|in:empresa,mentor',
        ]);

        $userType = $validatedData['user_type'];
        if ($userType === 'administrador' && Auth::id() !== config('app.admin_id')) {
            return redirect()->back()->withErrors(['user_type' => 'Você não tem permissão para definir este tipo de usuário.']);
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'user_type' => $userType,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso.');
    }
}