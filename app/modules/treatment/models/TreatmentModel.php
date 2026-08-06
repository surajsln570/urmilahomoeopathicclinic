<?php

namespace App\modules\treatment\models;

use Illuminate\Database\Eloquent\Model;

class TreatmentModel extends Model
{
    //
    protected $table = 'treatments';
    protected $fillable = [
        'disease',
        'image',
        'description',
        'symptoms'
    ];
}
