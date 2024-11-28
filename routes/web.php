<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\MentorDashboardController;
use App\Http\Controllers\MentorshipController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

// Página inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas de autenticação
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rota principal do dashboard (visão geral)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rotas protegidas para usuários autenticados
Route::middleware('auth')->group(function () {

    // Rotas genéricas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas específicas para empresas
    Route::middleware(['redirect.company'])->group(function () {
        Route::get('/dashboard/company', [CompanyDashboardController::class, 'index'])->name('dashboard.company');
        Route::get('/profile/company', [ProfileController::class, 'showCompanyProfile'])->name('profile.company');
        Route::get('/profile/company/edit', [ProfileController::class, 'editCompanyProfile'])->name('profile.company.edit');
        Route::patch('/profile/company', [ProfileController::class, 'updateCompanyProfile'])->name('profile.company.update');
        Route::delete('/profile/company', [ProfileController::class, 'destroyCompanyProfile'])->name('profile.company.destroy');

        // Rota para solicitar mentoria
        Route::post('/mentorships/request/{mentor}', [MentorshipController::class, 'request'])->name('mentorship.request');
    });

    // Rotas específicas para mentores
    Route::middleware(['redirect.mentor'])->group(function () {
        Route::get('/dashboard/mentor', [MentorDashboardController::class, 'index'])->name('dashboard.mentor');
        Route::get('/profile/mentor', [ProfileController::class, 'showMentorProfile'])->name('profile.mentor');

        // Rotas para aceitar ou recusar mentorias
        Route::patch('/mentorship/{id}/accept', [MentorshipController::class, 'accept'])->name('mentorship.accept');
        Route::patch('/mentorship/{id}/reject', [MentorshipController::class, 'reject'])->name('mentorship.reject');

        // Rota para visualizar mentorias aceitas
        Route::get('/dashboard/mentor/accepted-mentorships', [MentorshipController::class, 'acceptedMentorships'])->name('mentorship.accepted');
    });

    // Gerenciamento de usuários (somente para administradores ou gestores)
    Route::middleware(['admin'])->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    });
});

// Rota para página de acesso negado
Route::get('/no-access', function () {
    return view('no-access');
})->name('no-access');

// Inclui as rotas de autenticação padrão
require __DIR__ . '/auth.php';
