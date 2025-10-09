<?php

use App\Http\Controllers\Admin\AccessControlController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

// Public routes
Route::get('/', function () {
    // return view('home');
    return view('home');
    // Route::view('/', 'home')->name('home');
});

Route::get('/sitemap.xml', function () {

    set_time_limit(300);

    $sitemap = Sitemap::create()
        ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))

    // Static Pages
        ->add(Url::create('/about')
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
        ->add(Url::create('/contact')
                ->setPriority(0.6)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));

    Product::all()->each(function ($product) use ($sitemap) {
        $sitemap->add(
            Url::create("/products/{$product->slug}")
                ->setLastModificationDate($product->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.7)
        );
    });

    $sitemap->writeToFile(public_path('sitemap.xml'));
    return response()->file(public_path('sitemap.xml'));
});

// Public routes
Route::view('/about', 'about')->name('about');
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [NotificationController::class, 'submitForm'])->name('contact.submit');

// Public product/category details
Route::get('/products/{product:slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('public.products.show');
Route::get('/categories/{category:slug}', [App\Http\Controllers\CategoryController::class, 'show'])->name('public.categories.show');

// Authentication routes
require __DIR__ . '/auth.php';

// ================= ADMIN ROUTES =================
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/no-permission', [DashboardController::class, 'noPermission'])->name('no-permission');

    // Users
    Route::resource('users', UserController::class)->except(['edit', 'update', 'destroy', 'show'])
        ->middleware('check.permission:view-users');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('check.permission:update-users');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('check.permission:update-users');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('check.permission:delete-users');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('check.permission:view-users');

    // Customers
    Route::resource('customers', CustomerController::class)->middleware('check.permission:view-customers');
    Route::get('customers/data', [CustomerController::class, 'data'])->name('customers.data')->middleware('check.permission:view-customers');
    Route::get('customers-export-csv', [CustomerController::class, 'exportCsv'])->name('customers-export-csv')->middleware('check.permission:view-customers');

    // Quotations
    Route::prefix('quotations')->name('quotations.')->group(function () {
        Route::get('customers-autocomplete', [QuotationController::class, 'customersAutocomplete'])->name('customersAutocomplete');
        Route::get('customer-details', [QuotationController::class, 'getCustomerDetails'])->name('getCustomerDetails');
    });

  // Main quotation resource routes
    Route::resource('quotations', QuotationController::class)
    ->only(['index', 'create', 'store', 'show', 'destroy'])
    ->middleware('check.permission:view-quotations');
    
    // Quotation product details route (outside group for clarity)
    Route::get('quotations/product/{product:id}', [QuotationController::class, 'productDetails'])->name('quotations.product');
    Route::get('quotations/{quotation}/revise', [QuotationController::class, 'revise'])->name('quotations.revise')->middleware('check.permission:create-quotations');
    Route::get('quotations/{quotation}/edit', [QuotationController::class, 'edit'])
    ->name('quotations.edit')
    ->middleware('check.permission:update-quotations');
    Route::get('quotations/{quotation}/download', [QuotationController::class, 'download'])->name('quotations.download')->middleware('check.permission:view-quotations');
    Route::get('quotations/{quotation}/preview', [QuotationController::class, 'preview'])->name('quotations.preview')->middleware('check.permission:view-quotations');

    // Products (admin only, no slug route here!)
    Route::get('products/get-by-category', [ProductController::class, 'getByCategory'])->name('products.getByCategory');
    Route::resource('products', ProductController::class)->middleware('check.permission:view-products');
    Route::post('products/{product}/upload-images', [ProductController::class, 'uploadImages'])->name('products.upload-images')->middleware('check.permission:update-products');
    Route::delete('products/images/{media}', [ProductController::class, 'deleteImage'])->name('products.delete-image')->middleware('check.permission:update-products');

    // Categories
    Route::resource('categories', CategoryController::class)->middleware('check.permission:view-categories');

    // Brands
    Route::resource('brands', BrandController::class)->middleware('check.permission:view-brands');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index')->middleware('check.permission:view-inquiries');
    Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('notification.show')->middleware('check.permission:read-inquiries');

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index')->middleware('check.permission:view-settings');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update')->middleware('check.permission:update-settings');

    // Access Control
    Route::middleware(['role:super-admin'])->prefix('access-control')->name('access-control.')->group(function () {
        Route::get('/', [AccessControlController::class, 'index'])->name('index');
        Route::get('/roles', [AccessControlController::class, 'roles'])->name('roles');
        Route::post('/roles', [AccessControlController::class, 'storeRole'])->name('roles.store');
        Route::put('/roles/{role}', [AccessControlController::class, 'updateRole'])->name('roles.update');
        Route::delete('/roles/{role}', [AccessControlController::class, 'destroyRole'])->name('roles.destroy');
        Route::get('/roles/{role}/permissions', [AccessControlController::class, 'getRolePermissions'])->name('roles.permissions');
    });

    // Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
