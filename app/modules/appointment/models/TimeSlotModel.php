<?php

namespace App\modules\appointment\models;

use Illuminate\Database\Eloquent\Model;

class TimeSlotModel extends Model
{
    protected $table = 'time_slots';

    protected $fillable = [
        'day',
        'start_time',
        'end_time',
        'status',
        'mode'
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    public function appointments()
    {
        return $this->hasMany(AppointmentModel::class, 'time_slot_id');
    }
}
