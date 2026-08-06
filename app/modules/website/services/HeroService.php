<?php

namespace App\modules\website\services;

use App\modules\website\models\HeroImage;

class HeroService
{
    public function upload($file)
    {
        // dd($file);
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('upload/hero'), $filename);
        try {
            $heroImage =  HeroImage::create([
                'heroimage' => 'upload/hero/' . $filename
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        // dd('hell');
        return [
            'success' => true,
            'message' => 'Hero image uploaded successfully',
            'data' => $heroImage
        ];
    }
    public function get()
    {

        return ['message' => 'successful', 'data' => HeroImage::latest()->get()];
    }

    public function update($image, $id)
    {
        $heroImage = HeroImage::findOrFail($id);
        $heroImage->update([
            'hero_images' => 'image'
        ]);
    }
}
