<?php
// routes/web.php

use App\Http\Controllers\PaymentSuccessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RoomController::class, 'index'])->name('landing');

// Payment routes
Route::get('/payments/payment-confirmation', [RoomController::class, 'showPaymentConfirmationForm'])
    ->name('payment-confirmation');
Route::post('/payments/payment-confirmation', [RoomController::class, 'processPayment'])
    ->name('payment-confirmation.store');
Route::get('/payments/payment-success', [PaymentSuccessController::class, 'show'])
    ->name('payment-success');

// Auth routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
