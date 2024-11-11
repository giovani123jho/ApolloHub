<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\MentorDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rota para login personalizada
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Rota para logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rota principal do dashboard, sem o middleware de redirecionamento
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rotas protegidas para usuários autenticados
Route::middleware('auth')->group(function () {
    // Rotas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas para o gerenciamento de usuários
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    
    // Rota específica do dashboard da empresa com o middleware de redirecionamento
    Route::get('/dashboard/company', [CompanyDashboardController::class, 'index'])
        ->middleware('redirect.company')
        ->name('dashboard.company');

    // Rota específica do dashboard do mentor, sem o middleware de redirecionamento de empresa
    Route::get('/dashboard/mentor', [MentorDashboardController::class, 'index'])
        ->name('dashboard.mentor');
});

// Inclui as rotas de autenticação padrão, se necessário
require __DIR__.'/auth.php';