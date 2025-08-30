<?php
namespace App\Providers;

use App\Models\Category;
use App\Settings\GeneralSettings;
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
    public function boot(GeneralSettings $settings): void
    {
        // // Register view composer for global settings
        // View::composer(['layouts.app', 'admin.layouts.app'], \App\View\Composers\SettingsComposer::class);
        
        // View::composer('*', function ($view) {
        //     $view->with('categories', \App\Models\Category::where('is_active', 1)->with(['children' => function ($q)  {
        //         $q->where('is_active', 1);
                
        //     }])->get());
        // });




          // Register view composer for global settings
        View::composer(['layouts.app', 'admin.layouts.app'], \App\View\Composers\SettingsComposer::class);

          // Share categories + global settings with all views
        View::composer('*', function ($view) use ($settings) {
            $categories = Category::where('is_active', 1)
                ->with(['children' => function ($q) {
                    $q->where('is_active', 1);
                }])
                ->get();

            $view->with([
                'categories' => $categories,
                'globalSettings' => $settings,
            ]);
        });

    }
}
