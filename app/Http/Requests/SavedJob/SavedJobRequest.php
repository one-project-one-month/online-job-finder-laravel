<?php

namespace App\Http\Requests\SavedJob;

use Illuminate\Foundation\Http\FormRequest;

class SavedJobRequest extends FormRequest
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
            'applicant_id'=>'exists:applicant_profiles,id',
            'job_post_id'=>'required|numeric|exists:job_posts,id'
        ];
    }
}
