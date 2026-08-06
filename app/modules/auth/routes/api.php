<?php
use Illuminate\Support\Facades\Route;
use App\Modules\Auth\Controllers\RegisterController;
use App\Modules\Auth\Controllers\LoginController;


Route::post('/register', [RegisterController::class, 'register']);
Route::get('/register', [RegisterController::class, 'show']);

Route::post('/login', [LoginController::class, 'login']);
Route::get('/login', [LoginController::class, 'show']);