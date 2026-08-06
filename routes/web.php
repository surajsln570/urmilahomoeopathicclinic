<?php

use App\modules\treatment\models\TreatmentModel;
use App\modules\website\models\HeroImage;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/inertia-test', function () {
    return Inertia::render('Test', [
        'message' => 'Hello from Inertia + React',
    ]);
});

Route::get('/', function () {
    $heroImages = HeroImage::where('status', 1)->latest()->get();
    $treatments = TreatmentModel::latest()->get();
    // dd($heroImages);
    return view(
        'website::screens.homescreen.homescreen',
        ['heroImages' => $heroImages, 'treatments' => $treatments]

    );
});
