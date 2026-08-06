<?php

namespace app\modules\patient\routes;

use Illuminate\Support\Facades\Route;
use App\Modules\Patient\Controllers\PatientController;

Route::prefix('patients')
    ->name('patients.')
    ->controller(PatientController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');

        Route::post('/', 'store')->name('store');

        Route::get('/{id}/edit', 'edit')->name('edit');

        Route::put('/{id}', 'update')->name('update');

        Route::delete('/{id}', 'destroy')->name('destroy');
    });
