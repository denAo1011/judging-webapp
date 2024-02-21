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
            'tallies.*.entry_id' => ['required', 'numeric', 'exists:company_entries,id'],
            'tallies.*.rating' => ['required', 'numeric', 'min:1', 'max:10'],
        ];
    }
}
