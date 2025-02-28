<?php
// app/Http/Requests/StoreJobCategoryRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class UpdateJobCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true; // For simplicity, returning true
    }

    public function rules()
    {
        return [
            'name'=>'required|string|max:255' . $this->job_category,
            'description' => 'nullable|string|max:500',
        ];
    }
}
