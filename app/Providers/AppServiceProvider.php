<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register view composer for global settings
        View::composer(['layouts.app', 'admin.layouts.app'], \App\View\Composers\SettingsComposer::class);
        
        View::composer('*', function ($view) {
            $view->with('categories', \App\Models\Category::where('is_active', 1)->get());
        });
    }
}
