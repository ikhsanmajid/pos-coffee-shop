<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users
    Route::get('/users', [UsersController::class, 'index'])->name('users');

    // Test
    Route::get('/test', [TestController::class, 'index'])->name('test');
});

// Fetch (API-like routes)
Route::prefix('fetch')->name('fetch.')->group(function () {
    Route::get('test', [TestController::class, 'testSelect'])->name('test');
});

require __DIR__.'/auth.php';
