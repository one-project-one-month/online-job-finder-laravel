<?php

namespace App\Http\Resources\Application;

use Illuminate\Http\Request;
use App\Http\Resources\ResumeResource;
use App\Http\Resources\Job\JobResource;
use App\Http\Resources\ApplicantProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'resume_id'=>$this->resume_id,
            'job_post_id'=>$this->job_post_id,
            'status'=>$this->status,
            'applicant_id'=>$this->applicant_id,
            'applied_at'=>$this->applied_at,
            'lock_version'=>$this->lock_version,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'resume'=>ResumeResource::make($this->resume),
            'applicant'=>ApplicantProfileResource::make($this->applicant),
            'jobPost'=>JobResource::make($this->jobPost)

        ];
    }
}
