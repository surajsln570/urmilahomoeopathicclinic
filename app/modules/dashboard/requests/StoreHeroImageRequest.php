<?php

namespace App\modules\dashboard\requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreHeroImageRequest extends FormRequest
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
            'heroimage' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ];
    }
    #[Override]
    public function messages()
    {
        return [
            'heroimage.required' => 'Hero heroimage is required.',
            'heroimage.image' => 'File must be an heroimage.',
            'heroimage.mimes' => 'Only jpg, jpeg, png, webp allowed.',
            'heroimage.max' => 'heroimage size must be less than 2MB.',
        ];
    }
}
