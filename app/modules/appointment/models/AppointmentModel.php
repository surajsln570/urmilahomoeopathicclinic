<?php

namespace App\modules\appointment\models;

use Illuminate\Database\Eloquent\Model;

class AppointmentModel extends Model
{
    protected $table = 'appointment';

    protected $fillable = [
        'date',
        'patient_name',
        'patient_mobile',
        'time_slot_id', // FK -> time_slots.id
        'mode'
    ];

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlotModel::class, 'time_slot_id');
    }
}
