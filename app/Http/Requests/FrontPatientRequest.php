<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FrontPatientRequest extends FormRequest
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
            "name"          => "required|unique:patients|string|min:5",
            "email"         => "required|unique:patients|email",
            "password"      => "required|string",
            "lname"         => "string|nullable",
            "fname"         => "string|nullable",
            "birth_date"    => 'date|nullable',
            "address"       => 'string|nullable',
            "phone"         => 'string|nullable',
            "blood"         => Rule::in(Patient::bloud_group),
            "sex"           => Rule::in(['male' , 'female']),

        ];
    }
}
