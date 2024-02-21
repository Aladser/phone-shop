<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PhoneController::class, 'index'])->name('main');
Route::get('/dashboard', [OrderController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::delete('/order', [OrderController::class, 'destroy'])->name('order.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/phone', PhoneController::class)
    ->except(['show', 'create', 'edit', 'update', 'destroy'])
    ->middleware(['auth']);

require __DIR__.'/auth.php';
