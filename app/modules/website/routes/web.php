<?php

namespace App\modules\website\routes;

use App\modules\website\controllers\HeroController;
use App\modules\website\controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/heroimage', [HeroController::class, 'show'])->name('heroimage');
Route::post('/heroimage', [HeroController::class, 'store'])->name('heroimage.store');
Route::put('/heroimage', [HeroController::class, 'upload'])->name('hero-images.edit');
Route::delete('/heroimage/{id}', [HeroController::class, 'destroy'])->name('hero-images.destroy');
Route::put('/heroimage/status/{id}', [HeroController::class, 'status'])->name('hero-images.status');
Route::get('/appointment', [WebsiteController::class, 'showAppointmentForm'])->name('show-appointment-form');
