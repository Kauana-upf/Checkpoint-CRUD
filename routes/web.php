<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\NotaController;

use Illuminate\Support\Facades\Route;

// Página inicial
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard protegido por login e e-mail verificado
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rotas que só usuários logados podem acessar
Route::middleware(['auth'])->group(function () {

    // Redireciona "settings" para "settings/profile"
    Route::redirect('settings', 'settings/profile');

    // Configurações do usuário via Livewire
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // Página do boletim
    Route::get('/boletim', function () {
        return view('boletim');
    });

    // CRUD completo
    Route::resource('alunos', AlunoController::class);
    Route::resource('disciplinas', DisciplinaController::class);
    Route::resource('professores', ProfessorController::class)->parameters([
        'professores' => 'professor' // Define parâmetro singular
    ]);
    Route::resource('notas', NotaController::class);
});

// Rotas de autenticação
require __DIR__.'/auth.php';
