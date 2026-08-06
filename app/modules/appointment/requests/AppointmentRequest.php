<?php

namespace App\modules\appointment\requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'patient_name'   => 'required|string|max:255',
            'patient_mobile' => 'required|digits:10',
            'date'           => 'required|date|after_or_equal:today',
            'time_slot_id'   => 'required|integer|exists:time_slots,id',
        ];
    }
    public function messages(): array
    {
        return [
            'patient_mobile.digits' => 'Mobile number must be exactly 10 digits.',
            'date.after_or_equal'   => 'Appointment date cannot be in the past.',
            'time_slot_id.exists'   => 'Selected time slot is invalid.',
        ];
    }
}
