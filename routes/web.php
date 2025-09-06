<?php

use App\Http\Controllers\Admin\AccessControlController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
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
Route::post('/contact', [NotificationController::class, 'submitForm'])->name('contact.submit');

// Public category routes
Route::get('/products/{product:slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{category:slug}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');


// Test route to check if basic functionality works

// Authentication routes (handled by Breeze)
require __DIR__ . '/auth.php';

// Admin routes (protected by auth and permissions)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/no-permission', [DashboardController::class, 'noPermission'])->name('no-permission');



    // User Management (Super Admin only)
    // Route::middleware(['role:super-admin'])->group(function () {
    //     Route::resource('users', UserController::class);
    //     Route::post('users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assign-role');
    // });

    // List users
    Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware('check.permission:view-users');
    // Show create form
    Route::get('users/create', [UserController::class, 'create'])->name('users.create')->middleware('check.permission:create-users');
    // Store new user
    Route::post('users', [UserController::class, 'store'])->name('users.store')->middleware('check.permission:create-users');
    // Show single user
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('check.permission:view-users');
    // Show edit form
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('check.permission:update-users');
    // Update user
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('check.permission:update-users');
    // Delete user
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('check.permission:delete-users');

    // Product Management
    // Route::middleware(['permission:manage-products'])->group(function () {
    //     Route::resource('products', ProductController::class);
    //     Route::post('products/{product}/upload-images', [ProductController::class, 'uploadImages'])->name('products.upload-images');
    //     Route::delete('products/images/{media}', [ProductController::class, 'deleteImage'])->name('products.delete-image');
    // });

    // List products
    Route::get('products', [ProductController::class, 'index'])->name('products.index')->middleware('check.permission:view-products');
    // Show create form
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create')->middleware('check.permission:create-products');
    // Store product
    Route::post('products', [ProductController::class, 'store'])->name('products.store')->middleware('check.permission:create-products');
    // Show single product
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show')->middleware('check.permission:view-products');
    // Show edit form
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('check.permission:update-products');
    // Update product
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update')->middleware('check.permission:update-products');
    // Delete product
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('check.permission:delete-products');
    // Upload product images
    Route::post('products/{product}/upload-images', [ProductController::class, 'uploadImages'])->name('products.upload-images')->middleware('check.permission:update-products');
    // Delete product images
    Route::delete('products/images/{media}', [ProductController::class, 'deleteImage'])->name('products.delete-image')->middleware('check.permission:update-products');

    // Category Management
    // Route::middleware(['permission:manage-categories'])->group(function () {
    //     Route::resource('categories', CategoryController::class);
    // });

    // List categories
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('check.permission:view-categories');

    // Show create form
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('check.permission:create-categories');

    // Store category
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store')->middleware('check.permission:create-categories');

    // Show single category
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show')->middleware('check.permission:view-categories');

    // Show edit form
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('check.permission:update-categories');

    // Update category
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update')->middleware('check.permission:update-categories');

    // Delete category
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('check.permission:delete-categories');

    // // Brand Management
    // Route::middleware(['permission:manage-brands'])->group(function () {
    //     Route::resource('brands', BrandController::class);
    // });

    // List brands
    Route::get('brands', [BrandController::class, 'index'])->name('brands.index')->middleware('check.permission:view-brands');
    // Show create form
    Route::get('brands/create', [BrandController::class, 'create'])->name('brands.create')->middleware('check.permission:create-brands');
    // Store brand
    Route::post('brands', [BrandController::class, 'store'])->name('brands.store')->middleware('check.permission:create-brands');
    // Show single brand
    Route::get('brands/{brand}', [BrandController::class, 'show'])->name('brands.show')->middleware('check.permission:view-brands');
    // Show edit form
    Route::get('brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit')->middleware('check.permission:update-brands');
    // Update brand
    Route::put('brands/{brand}', [BrandController::class, 'update'])->name('brands.update')->middleware('check.permission:update-brands');
    // Delete brand
    Route::delete('brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy')->middleware('check.permission:delete-brands');
    // Brand Management

    // Route::middleware(['role:super-admin'])->group(function () {
    //     // routes/web.php
    //     Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    //     Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('notification.show');
    // });

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index')->middleware('check.permission:view-inquiries');
    Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('notification.show')->middleware('check.permission:read-inquiries');

    // Settings Management (Super Admin only)
    // Route::middleware(['role:super-admin'])->group(function () {
    //     Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    //     Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    // });

    // View settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index')->middleware('check.permission:view-settings');
    // Update settings
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update')->middleware('check.permission:update-settings');

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
