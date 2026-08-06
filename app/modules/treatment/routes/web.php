<?php

namespace App\modules\treatment\routes;

use App\modules\treatment\controllers\TreatmentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/treatment', [TreatmentController::class, 'store'])->name('treatment.store');
    Route::delete('/treatment/{id}', [TreatmentController::class, 'delete'])->name('treatment.delete');
    Route::put('/treatment/{id}', [TreatmentController::class, 'update'])->name('treatment.edit');
    Route::get('/dash-treatment', [TreatmentController::class, 'show'])->name('dashtreatment.show');
});
