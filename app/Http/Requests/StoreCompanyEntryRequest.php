<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyEntryRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'link' => ['required', 'string'],
            'title' => ['required', 'string'],
            'day_of_airing' => ['required', 'string', 'in:MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATURDAY,SUNDAY'],
            'time_of_airing' => ['required', 'date_format:H:i'],
            'production_company' => ['required', 'string'],
            'synopsis' => ['required', 'string'],

            'contact_person' => ['required', 'string'],
            'contact_person_email' => ['required', 'email'],
            'contact_person_number' => ['required', 'string'],

            'producers' => ['nullable', 'string'],
            'executive_producers' => ['nullable', 'string'],
            'premiere_date' => ['nullable', 'date'],
            'directors' => ['nullable', 'string'],
            'writers' => ['nullable', 'string'],

            'payment_reference' => ['required'],
        ];
    }
}
