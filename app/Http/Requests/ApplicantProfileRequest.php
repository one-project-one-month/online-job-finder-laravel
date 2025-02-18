<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=>'required|integer',
            'full_name'=>'required|string|max:100',
            'phone'=>'required|numeric|min:15|unique:applicant_profiles,phone',
            'address'=>'required|string',
            'location_id'=>'required|exists:locations,id',
            'description'=>'required|string'
        ];
    }
}
