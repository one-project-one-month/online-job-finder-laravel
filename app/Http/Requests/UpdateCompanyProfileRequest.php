<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyProfileRequest extends FormRequest
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
            'company_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:company_profiles,phone'.$this->company_profile,
            'website' => 'required|url|max:255',
            'address' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'description' => 'required|string',
        ];
    }
}
