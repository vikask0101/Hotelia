<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Category\CategoryController;
use App\Http\Controllers\Backend\Dashboard\DashboardController;
use App\Http\Controllers\Backend\Rooms\Amenities\AmenityController;

Route::prefix('admin')->as('admin.')->group(function () {
    // Login Routes
    Route::get('login', [LoginController::class, 'showLoginPage'])
        ->name('showLoginPage')
        ->middleware('guest');
    Route::post('login', [LoginController::class, 'postLogin'])
        ->name('login');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'showDashboardPage'])
            ->name('dashboard');

        // Category Routes
        Route::put('/categories/{category}/status', [CategoryController::class, 'updateStatus'])
            ->name('categories.update.status');
        Route::resource('categories', CategoryController::class);

        // Room Routes
        Route::prefix('rooms')->as('rooms.')->group(function () {
            Route::put('/amenities/{amenity}/status', [AmenityController::class, 'updateStatus'])
                ->name('amenities.update.status');
            Route::resource('amenities', AmenityController::class);

        });
    });

});


Route::get('/login', function () {
    \Log::alert("message");
})->name('login');
