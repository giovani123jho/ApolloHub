<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MentorDashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Rota principal do dashboard com middleware para redirecionar empresas
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'redirect.company'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas para o gerenciamento de usuários
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    
    // Rota específica do dashboard da empresa
    Route::get('/dashboard/company', [CompanyDashboardController::class, 'index'])->name('dashboard.company');


    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard/mentor', [MentorDashboardController::class, 'index'])->name('dashboard.mentor');
    });
});

require __DIR__.'/auth.php';

