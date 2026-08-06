<?php

namespace App\modules\patient\models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'age',
        'sex',
        'religion',
        'address',
        'remark',
        'registrationNumber',
        'bloodGroup',
        'mobile',
        'patientName',
    ];

    protected $casts = [
        'age' => 'integer',
        'registrationNumber' => 'integer',
    ];
}
