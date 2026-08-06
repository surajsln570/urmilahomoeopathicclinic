<?php

namespace App\modules\appointment\requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TimeSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // adjust with a policy if needed
    }

    public function rules(): array
    {
        return [
            'day' => ['required', Rule::in([
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday',
            ])],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time'   => ['required', 'date_format:H:i', 'after:start_time'],
            'status'     => ['sometimes', 'boolean'],
        ];
    }
}
