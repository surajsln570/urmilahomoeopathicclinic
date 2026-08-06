<?php

namespace App\modules\user\routes;

use App\Modules\User\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/create-user', [UserController::class, 'show'])->name('create-user');
Route::post('/create-user', [UserController::class, 'create'])->name('create-user.post');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.put');
Route::get('/users', [UserController::class, 'getUser'])->name('users');
Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('users.delete');
