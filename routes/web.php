<?php

use App\Http\Controllers\AffaireController;
use App\Http\Controllers\AssuranceController;
use App\Http\Controllers\AssureurController;
use App\Http\Controllers\CategoryPersonController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MouvementPoliceController;
use App\Http\Controllers\PoliceController;
use App\Http\Controllers\PrimeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/home', function () {
    return view('home');
})->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('category_people', CategoryPersonController::class);
    Route::get('/import-pays', [\App\Http\Controllers\PaysController::class, 'importPays']);
    Route::resource('clients', ClientController::class);
    Route::resource('affaires', AffaireController::class);
    Route::resource('mouvements', MouvementPoliceController::class);
    Route::resource('assureurs', AssureurController::class);
    Route::resource('polices',PoliceController::class);
    Route::resource('assurances',AssuranceController::class);
    Route::resource('polices',PoliceController::class);
    Route::resource('primes',PrimeController::class);
    Route::resource('factures',FactureController::class);
    Route::resource('commissions',CommissionController::class);

});
