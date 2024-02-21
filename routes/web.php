<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PhoneController::class, 'index'])->name('main');
Route::get('/dashboard', [OrderController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard');

// Order
Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::delete('/order', [OrderController::class, 'destroy'])->name('order.destroy');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Phone
Route::get('/phone', [PhoneController::class, 'index'])->middleware(['auth'])->name('phone.index');
Route::post('/phone', [PhoneController::class, 'store'])->middleware(['auth'])->name('phone.store');

require __DIR__.'/auth.php';
