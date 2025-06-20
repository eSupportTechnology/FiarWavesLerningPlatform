<?php

namespace App\Providers;

use App\Models\LandingPageContent;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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
        Route::prefix('api')
        ->middleware('api')
        ->group(base_path('routes/api.php'));

        View::composer('*', function ($view) {
            $view->with('landingPageContent', LandingPageContent::first());
        });
    }
}
