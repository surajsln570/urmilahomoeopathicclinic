<?php

namespace App\Modules\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('appointment'));
    }

    public function rules(): array
    {
        return [
            'patient_id'        => ['required', 'exists:patients,id'],
            'doctor_id'         => ['required', 'exists:doctors,id'],
            'appointment_date'  => ['required', 'date', 'after_or_equal:today'],
            'appointment_time'  => ['required', 'date_format:H:i'],
            'status'            => ['sometimes', Rule::in(['pending', 'confirmed', 'cancelled', 'completed'])],
            'notes'             => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'appointment_date.after_or_equal' => 'The appointment date cannot be in the past.',
        ];
    }
}
