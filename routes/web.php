<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;

Route::get('/', fn() => redirect()->route('dashboard'));

Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware('solo.admin')->group(function () {
        Route::resource('usuarios', UsuarioController::class)
            ->except(['show']);
    });

    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/profile/edit', fn() => view('profile.edit'))->name('profile.edit');
    Route::post('/profile/edit', fn() => view('profile.edit'))->name('profile.update');
    Route::get('/profile/partials/update-password-form', fn() => view('profile.partials.update-password-form'))->name('profile.update');
    Route::get('/profile/partials/delete-user-form', fn() => view('profile.partials.delete-user-form'))->name('profile.delete-user');

    Route::resource('clientes', ClienteController::class)
        ->except(['show']);

    Route::resource('pacientes', PacienteController::class)
        ->except(['show']);

    Route::resource('citas', CitaController::class)
        ->except(['show']);
});

// Bloquear registro público
Route::get('/register', fn() => redirect()->route('login'))->name('register');
Route::post('/register', fn() => redirect()->route('login'));

require __DIR__ . '/auth.php';