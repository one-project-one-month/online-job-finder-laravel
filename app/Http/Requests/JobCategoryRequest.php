<?php
// app/Http/Requests/StoreJobCategoryRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class JobCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true; // For simplicity, returning true
    }

    public function rules()
    {
        return [
            'industry' => 'required|string|max:255|unique:job_categories,industry',
            'description' => 'nullable|string|max:500',
        ];
    }
}
