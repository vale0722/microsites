<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class);

Route::post('payments', [PaymentController::class, 'store'])
    ->name('payments.store');

Route::get('payments/{payment}', [PaymentController::class, 'show'])
    ->name('payments.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('sites', SiteController::class)
    ->names('sites')
    ->middleware(['auth', 'verified']);

Route::resource('categories', \App\Http\Controllers\CategoryController::class)
    ->names('categories');

require __DIR__.'/auth.php';
