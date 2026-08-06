<?php

namespace App\Modules\Dashboard\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\View;

class DashboardServiceProvider extends ServiceProvider
{
    public function boot()
    {

        Route::middleware('web')
            ->group(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // View::addLocation(resource_path('views'));
    }
    public function register() {}
}
