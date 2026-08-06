<?php

namespace App\modules\appointment\provider;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppointmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        Route::middleware(['web'])->group(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'appointment');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
