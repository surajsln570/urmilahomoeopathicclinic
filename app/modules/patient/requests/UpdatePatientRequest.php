<?php

namespace App\Modules\Patient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $patientId = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0', 'max:150'],
            'sex' => ['required', 'in:male,female,other'],
            'religion' => ['required', 'in:hindu,muslim,christian,sikh,other'],
            'address' => ['required', 'string'],
            'remark' => ['nullable', 'string'],
            'registrationNumber' => [
                'required',
                'integer',
                Rule::unique('patients', 'registrationNumber')->ignore($patientId),
            ],
            'bloodGroup' => [
                'required',
                'in:A+,A-,B+,B-,AB+,AB-,O+,O-'
            ],
            'mobile' => ['required', 'digits_between:10,15'],
            'patientName' => ['required', 'string', 'max:255'],
        ];
    }
}
