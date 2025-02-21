<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantEducationRequest extends FormRequest
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
            'applicant_id' => 'exists:applicant_profiles,id',
            'school_name' => 'required | string',
            'degree' => 'required | string',
            'field_of_study' => 'required | string',
            'description' => 'required | string',
        ];
    }
}
