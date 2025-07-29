<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MustahikController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mustahik', [MustahikController::class, 'index'])->name('mustahik.index');
Route::get('/data', [MustahikController::class, 'dat'])->name('mustahik.data');
Route::get('/mustahik/data', [MustahikController::class, 'data']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
