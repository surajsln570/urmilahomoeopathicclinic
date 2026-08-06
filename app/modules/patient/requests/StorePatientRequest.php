<?php

namespace App\Modules\Patient\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0', 'max:150'],
            'sex' => ['required', 'in:male,female,other'],
            'religion' => ['required', 'in:hindu,muslim,christian,sikh,other'],
            'address' => ['required', 'string'],
            'remark' => ['nullable', 'string'],
            'registrationNumber' => ['required', 'integer', 'unique:patients,registrationNumber'],
            'bloodGroup' => [
                'required',
                'in:A+,A-,B+,B-,AB+,AB-,O+,O-'
            ],
            'mobile' => ['required', 'digits_between:10,15'],
            'patientName' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'registrationNumber.unique' => 'Registration number already exists.',
            'mobile.digits_between' => 'Mobile number must be between 10 and 15 digits.',
        ];
    }
}
