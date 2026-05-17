<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;

Route::get('/', fn() => redirect()->route('dashboard'));

$authMiddleware = ['auth', 'two.factor.confirmed'];

if (config('vetcare.features.email_verification')) {
    $authMiddleware[] = 'verified';
}

if (config('vetcare.features.force_password_change')) {
    $authMiddleware[] = 'force.password.change';
}

Route::middleware($authMiddleware)->group(function () {

    Route::middleware('solo.admin')->group(function () {
        Route::resource('usuarios', UsuarioController::class)
            ->except(['show']);
    });

    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/two-factor', [ProfileController::class, 'updateTwoFactor'])->name('profile.two-factor.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
