<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitTallyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tallies' => ['required', 'array'],
            'tallies.*' => ['required', 'numeric', 'exists:company_entries,id'],
            'tallies.*.originality' => ['required', 'numeric', 'min:0', 'max:100'],
            'tallies.*.adaptability' => ['required', 'numeric', 'min:0', 'max:100'],
            'tallies.*.sustainability' => ['required', 'numeric', 'min:0', 'max:100'],
            'tallies.*.upliftment' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }
}
