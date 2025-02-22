<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'company_id'=>'required|exists:company_profiles,id',
            'comment'=>'nullable|string|min:3',
            'rating'=>'numeric|min:0|max:5'
        ];
    }
}
