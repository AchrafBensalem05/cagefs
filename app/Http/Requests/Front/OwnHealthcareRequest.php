<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OwnHealthcareRequest extends FormRequest
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
        $healthcareEntity = Auth::guard('healthcare')->user();

        return [
            "name"          => ["required",Rule::unique('healthcare_entities' , 'name')->ignore($healthcareEntity->id),"string" , "min:5"],
            "email"         => ["required" ,Rule::unique('healthcare_entities' , 'email')->ignore($healthcareEntity->id) , "email" ] ,
            "lname"         => "string|nullable",
            "fname"         => "string|nullable",
            "address"       => "string|nullable",
            "daira_id"      => "nullable",
            "description"   => "string|nullable",
        ];
    }
}
