<?php
namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
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
        $this->merge(['job_post_id' => $this->route('job_post_id')]);

        return [
            'job_post_id' => 'required|numeric|exists:Job_posts,id',
            'resume_id'   => 'required|numeric|exists:resumes,id',
        ];
    }
}
