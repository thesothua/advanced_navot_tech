<?php

use App\Http\Controllers\Admin\AccessControlController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    // return view('home');
    return view('home');
    // Route::view('/', 'home')->name('home');
});

Route::view('/about', 'about')->name('about');
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::view('/contact', 'contact')->name('contact');

// Public category routes
Route::get('/categories/{category:slug}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');

// Test route to check if basic functionality works

// Authentication routes (handled by Breeze)
require __DIR__ . '/auth.php';

// Admin routes (protected by auth and permissions)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

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
        Route::delete('products/images/{media}', [ProductController::class, 'deleteImage'])->name('products.delete-image');
    });

    // Category Management
    Route::middleware(['permission:manage-categories'])->group(function () {
        Route::resource('categories', CategoryController::class);
    });

    // Brand Management
    Route::middleware(['permission:manage-brands'])->group(function () {
        Route::resource('brands', BrandController::class);
    });

    // Quotation Management
    Route::resource('quotations', QuotationController::class)->only(['index','create','store','show']);
    Route::get('quotations/product/{product}', [QuotationController::class, 'productDetails'])->name('quotations.product');

    // Settings Management (Super Admin only)
    Route::middleware(['role:super-admin'])->group(function () {
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    });

    // Access Control Management (Super Admin only)
    Route::middleware(['role:super-admin'])->prefix('access-control')->name('access-control.')->group(function () {
        Route::get('/', [AccessControlController::class, 'index'])->name('index');
        Route::get('/roles', [AccessControlController::class, 'roles'])->name('roles');

        // Role management with permissions
        Route::post('/roles', [AccessControlController::class, 'storeRole'])->name('roles.store');
        Route::put('/roles/{role}', [AccessControlController::class, 'updateRole'])->name('roles.update');
        Route::delete('/roles/{role}', [AccessControlController::class, 'destroyRole'])->name('roles.destroy');
        Route::get('/roles/{role}/permissions', [AccessControlController::class, 'getRolePermissions'])->name('roles.permissions');
    });

    // ===================== profile route

    // Profile routes
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Public product routes
    Route::get('products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    Route::get('categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
});


