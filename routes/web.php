<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembreController;


Route::get('/', function () {
    return view('auth.login');
});


// Dashboard de gestion de membre
Route::get('/backoffice/gestion-membre/dashboard', [MembreController::class, 'dashboard'])->name('backoffice.dashboard');


// Gestion des Membres
Route::get('/backoffice/gestion-membre/membres-list', [MembreController::class, 'index'])->name('backoffice.membres-list');
Route::get('/backoffice/gestion-membre/create', [MembreController::class, 'create'])->name('membres.create');
Route::get('/backoffice/gestion-membre/{id}', [MembreController::class, 'show'])->name('membres.show');


/*Route::get('/dashboard', function () {
return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function(){
return view('auth.login');
});


//require __DIR__ . '/auth.php';
