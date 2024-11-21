<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HealthcareRequest extends FormRequest
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
        $healthcareEntity =  $this->route()->parameter('healthcareEntity');

        return [
            "name"          => [
                $healthcareEntity ? Rule::unique('healthcare_entities' , 'name')->ignore($healthcareEntity->id) : 'unique:healthcare_entities',
                "required", "string" , "min:5"
            ],
            "email"         => [
                $healthcareEntity ? Rule::unique('healthcare_entities' , 'email')->ignore($healthcareEntity->id) : 'unique:healthcare_entities',
                "required" , "email"
            ] ,
            "lname"         => "string|nullable",
            "fname"         => "string|nullable",
            "password"      =>  $healthcareEntity ?  'string|nullable' : "required|string",
            "address"       => "string|nullable",
            'phones'        => "string|nullable",
            "daira_id"      => "nullable",
            "description"   => "string|nullable",
            "opening_hours" => "required",
            "blocked"       => Rule::in(['yes' , 'no'])
        ];
    }
}
