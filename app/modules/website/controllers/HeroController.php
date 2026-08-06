<?php

namespace App\modules\website\controllers;

use App\Http\Controllers\Controller;
use App\modules\website\models\HeroImage;
use App\modules\website\requests\HeroRequest;
use App\Modules\Website\Services\HeroService;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class HeroController extends Controller
{
    //
    protected HeroService  $heroService;
    public function __construct(HeroService $heroService)
    {
        $this->heroService = $heroService;
        // throw new \Exception('Not implemented');
    }
    public function store(HeroRequest $request)
    {
        $file = $request->file('hero_images');
        $result = $this->heroService->upload($file);
        return redirect()->route('heroimage', $result);
    }
    public function show()
    {
        $result = $this->heroService->get();
        return Inertia::render('cms/HeroImage', [
            'heroImages' => HeroImage::latest()->get()
        ]);
    }
    public function destroy($id)
    {
        $heroImages = HeroImage::findOrFail($id);
        if (File::exists(public_path($heroImages->heroimage))) {
            File::delete(public_path($heroImages->heroimage));
        }
        $heroImages->delete();
        return redirect()->route('heroimage', [
            'success' => true,
            'message' => 'Hero image deleted successfully',
        ]);
    }
    public function status($id)
    {
        HeroImage::query()->update(['status' => false]);
        $heroImages = HeroImage::findOrFail($id);
        $heroImages->status = !$heroImages->status;
        $heroImages->save();
        return redirect()->route('heroimage');
    }
}
