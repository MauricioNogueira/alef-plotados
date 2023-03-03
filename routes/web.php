<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastraEscalaController;
use App\Http\Controllers\CadastraMoldeController;
use App\Http\Controllers\FiltroEscalaController;
use App\Http\Controllers\FiltroMoldeController;
use App\Http\Controllers\GeraMoldeController;
use App\Http\Controllers\TelaCadastraMoldeController;
use App\Http\Controllers\TelaCadastraEscalaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/cadastra', [CadastraEscalaController::class, 'cadastrar'])->name('cadastra.escala');
    Route::get('/escalas', [FiltroEscalaController::class, 'filtrar'])->name('escala.filtro');

    Route::get('/moldes', [FiltroMoldeController::class, 'filtrar'])->name('molde.filtro');

    Route::post('/moldes', [CadastraMoldeController::class, 'cadastrar'])->name('cadastra.molde');
    Route::post('/gerar-molde', [GeraMoldeController::class, 'gerar'])->name('gera.molde');

    Route::get('/moldes/cadastro', [TelaCadastraMoldeController::class, 'view'])->name('cadastra-molde.view');
    Route::get('/escalas/cadastro', [TelaCadastraEscalaController::class, 'view'])->name('cadastra-escala.view');
});

require __DIR__.'/auth.php';
