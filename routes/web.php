<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembreController;

// Route racine - Redirection vers la liste des membres
Route::get('/', function () {
    return redirect()->route('backoffice.membres-list');
});

// Route de test
Route::get('/test', function () {
    return 'Laravel fonctionne correctement !';
});

// Dashboard de gestion de membre
Route::get('/backoffice/gestion-membre/dashboard', [MembreController::class, 'dashboard'])->name('backoffice.dashboard');


// Gestion des Membres
Route::get('/backoffice/gestion-membre/membres-list', [MembreController::class, 'index'])->name('backoffice.membres-list');
Route::get('/backoffice/gestion-membre/create', [MembreController::class, 'create'])->name('membres.create');
Route::post('/backoffice/gestion-membre/store', [MembreController::class, 'store'])->name('membres.store');
Route::get('/backoffice/gestion-membre/{id}', [MembreController::class, 'show'])->name('membres.show');
Route::get('/backoffice/gestion-membre/{id}/edit', [MembreController::class, 'edit'])->name('membres.edit');
Route::put('/backoffice/gestion-membre/{id}', [MembreController::class, 'update'])->name('membres.update');
Route::delete('/backoffice/gestion-membre/{id}', [MembreController::class, 'destroy'])->name('membres.destroy');


/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//require __DIR__ . '/auth.php';
