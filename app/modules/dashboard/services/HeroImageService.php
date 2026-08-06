<?php

namespace App\modules\dashboard\services;

use App\Models\HeroImage;

class HeroImageService
{
    public function store($data)
    {
        HeroImage::create(
            [
                'heroimage' => $data['heroimage']
            ]
        );
        return [
            'success' => true,
            'message' => 'Hero image created successfully.'
        ];
    }
}
