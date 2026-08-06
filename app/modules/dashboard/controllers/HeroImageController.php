<?php

namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HeroImage;
use App\modules\dashboard\requests\StoreHeroImageRequest;
use App\modules\dashboard\services\HeroImageService;

class HeroImageController extends Controller
{
    protected HeroImageService $hero;

    public function __construct(HeroImageService $hero)
    {
        $this->hero = $hero;
    }

    public function show()
    {
        return view('dashboard::addimage');
    }

    public function store(StoreHeroImageRequest $request)
    {
        $result = $this->hero->store($request->validated());

        if (!$result['success']) {
            return back()->withErrors(
                ['heroimage' => $result['message']]
            );
        }
    }
}
