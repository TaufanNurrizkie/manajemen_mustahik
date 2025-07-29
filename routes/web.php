<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MustahikController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/mustahik', [MustahikController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/data', [MustahikController::class, 'dat'])->name('mustahik.data');
Route::get('/mustahik/data', [MustahikController::class, 'data']);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
