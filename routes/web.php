<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/property/{id}', [HomeController::class, 'propertyDetails'])->name('property.details');

// Admin routes
Route::prefix('admin')->group(function () {
    // Guest routes (for unauthenticated users)
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    
    
    // Protected routes (for authenticated admins)
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::get('/properties/create', [AdminDashboardController::class, 'create'])->name('admin.properties.create');
    Route::post('/properties/store', [AdminDashboardController::class, 'store'])->name('admin.properties.store');
        
        // Additional admin dashboard routes can be added here
        Route::get('/properties', [AdminDashboardController::class, 'properties'])->name('admin.properties');
    });
});
