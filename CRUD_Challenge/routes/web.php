<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/perfil', function () {
    return view('dashboard');
});

Route::get('/dashboard', [UsuarioController::class, 'index'])->middleware('auth')->name('dashboard');
Route::delete('/usuario/{usuario}', 
[UsuarioController::class, 'destroy'])->middleware('auth')->name('usuario.destroy');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::post('/validate', ValidacaoUsuarioController::class)->withoutMiddleware([VerifyCsrfToken::class]);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
