<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PhoneController::class, 'index'])->name('main');
Route::get('/dashboard', [OrderController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Order
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::delete('/order', [OrderController::class, 'destroy'])->name('order.destroy');
    // Phone
    Route::get('/phone', [PhoneController::class, 'index'])->name('phone.index');
    Route::post('/phone', [PhoneController::class, 'store'])->name('phone.store');
});

require __DIR__.'/auth.php';
