<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Auth\Controllers\RegisterController;
use App\Modules\Auth\Controllers\LoginController;

Route::middleware('guest')->group(function () {

    // Register
    Route::get('/register', [RegisterController::class, 'show'])->name('auth.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('auth.register.post');
    // dd("modules/auth/routes/web.php");

    // Login
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});
// dd("logout");
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('/csrf-test', function () {
//     dd(csrf_token());
// });
