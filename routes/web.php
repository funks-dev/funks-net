<?php
// routes/web.php

use App\Http\Controllers\PaymentConfirmationController;
use App\Http\Controllers\PaymentSuccessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RoomController::class, 'index'])->name('landing');

// Payment routes
Route::get('/payments/payment-confirmation', [RoomController::class, 'showPaymentConfirmationForm'])
    ->name('payment-confirmation');
Route::post('/payment-confirmation', [PaymentConfirmationController::class, 'store'])
    ->name('payment-confirmation.store');
Route::get('/payment-success', [PaymentSuccessController::class, 'show'])
    ->name('payment.success');

// Auth routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'showLoginForm'])->name('login');

require __DIR__.'/auth.php';
