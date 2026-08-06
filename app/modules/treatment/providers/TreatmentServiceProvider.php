<?php

namespace App\modules\treatment\providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TreatmentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::middleware('web')->group(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'treatment');
    }
}
