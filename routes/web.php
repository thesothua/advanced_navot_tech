<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SettingController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Test route to check if basic functionality works

// Authentication routes (handled by Breeze)
require __DIR__.'/auth.php';

// Admin routes (protected by auth and permissions)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    // Route::get('/test', function () {
    //     return 'Test route working!';
    // });
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // User Management (Super Admin only)
    Route::middleware(['role:super-admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::post('users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assign-role');
    });
    
    // Product Management
    Route::middleware(['permission:manage-products'])->group(function () {
        Route::resource('products', ProductController::class);
        Route::post('products/{product}/upload-images', [ProductController::class, 'uploadImages'])->name('products.upload-images');
        Route::delete('products/{product}/images/{media}', [ProductController::class, 'deleteImage'])->name('products.delete-image');
    });
    
    // Category Management
    Route::middleware(['permission:manage-categories'])->group(function () {
        Route::resource('categories', CategoryController::class);
    });
    
    // Brand Management
    Route::middleware(['permission:manage-brands'])->group(function () {
        Route::resource('brands', BrandController::class);
    });
    
    // Settings Management (Super Admin only)
    Route::middleware(['role:super-admin'])->group(function () {
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});

// Public product routes
Route::get('products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');






