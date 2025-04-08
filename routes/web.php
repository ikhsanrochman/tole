<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminProfileController;


// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/property/{id}', [HomeController::class, 'propertyDetails'])->name('property.details');

// Admin routes
Route::prefix('admin')->group(function () {
    // Guest routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    

    // Protected routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        // Property management (CRUD) - resourceful route
        Route::resource('properties', PropertyController::class, [
            'as' => 'admin' // generates routes like admin.properties.index, admin.properties.edit, etc.
        ]);
        
        // Delete image from a property (optional)
        Route::delete('/properties/{property}/cover-image', [PropertyController::class, 'deleteCoverImage'])
        ->name('admin.properties.deleteCoverImage');
        Route::delete('/properties/{property}/detail-image/{image}', [PropertyController::class, 'deleteDetailImage'])
        ->name('admin.properties.deleteDetailImage');
        Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::post('/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    });
});
