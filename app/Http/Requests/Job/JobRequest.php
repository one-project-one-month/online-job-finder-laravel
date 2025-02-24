<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
        //   id varchar [primary key]
        //   company_id varchar
        //   title varchar
        //   job_category_id varchar
        //   location_id varchar
        //   type ENUM("Remote", "OnSite", "Hybrid")
        //   description text
        //   requirements text
        //   num_of_posts int
        //   salary decimal
        //   address varchar
        //   status enum("Open", "Close")
        //   version int
        //   created_at timestamp
        //   updated_at timestamp
        return [
            'company_id'=>'numeric|exists:company_profile,id',
            'title'=>'required|string|min:3|max:255',
            'job_category_id'=>'required|numeric|exists:job_categories,id',
            'location_id'=>'required|numeric|exists:locations,id',
            'type'=>'required|in:Remote,OnSite,Hybrid',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'num_of_posts' => 'required|integer|min:1',
            'salary' => 'nullable|numeric|min:0',
            'address' => 'nullable|string|max:255',
            'status' => 'required|in:Open,Close',
        ];
    }
}
