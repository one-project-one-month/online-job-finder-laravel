<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantExperienceRequest extends FormRequest
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
            'applicant_id' => 'required|string|exists:applicant_profiles,id',
            'company_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'job_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'currently_working' => 'boolean',
            'version' => 'integer|min:1',
        ];
    }
}
