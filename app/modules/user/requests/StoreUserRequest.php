<?php

namespace App\Modules\User\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        // dd("request");
        return [
            //
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:12',
            'email' => 'email',
            'password' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'email.unique' => 'email already exist',
            'password.min' => 'password must be atleast 6 charactors'
        ];
    }
}
