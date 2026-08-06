<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    // Route::get('/heroimage', function () {
    //     return view('dashboard::hero');
    // })->name('heroimage');
    // Route::get('/heroimage', function () {
    //     return view('dashboard::hero');
    // })->name('heroimage');
    // Route::get('/heroimage', function () {
    //     return view('dashboard::hero');
    // })->name('heroimage');
});
