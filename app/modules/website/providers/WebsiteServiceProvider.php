<?php

namespace App\Modules\Website\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

class WebsiteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'website');
        // $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        Route::middleware('web')->group(__DIR__ . '/../routes/web.php');
        Blade::componentNamespace(
            base_path('app/modules/website/resources/views/components'),
            'website'
        );
    }
    public function register() {}
}
