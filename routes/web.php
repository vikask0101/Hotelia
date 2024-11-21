<?php

use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginPage'])
    ->name('showLoginPage')
    ->middleware('guest');

    Route::post('login', [LoginController::class, 'postLogin'])
    ->name('login');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'showDashboardPage'])
            ->name('dashboard');
    });

});


Route::get('/login', function () {
    \Log::alert("message");
})->name('login');
