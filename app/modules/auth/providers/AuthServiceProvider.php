<?php

namespace App\Modules\Auth\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // dd("AuthProvider");

        // $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        Route::middleware('web')
            ->group(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'auth');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
    public function register() {}
}
