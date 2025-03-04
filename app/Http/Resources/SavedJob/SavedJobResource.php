<?php

namespace App\Http\Resources\SavedJob;

use App\Http\Resources\ApplicantProfileResource;
use Illuminate\Http\Request;
use App\Http\Resources\Job\JobResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SavedJobResource extends JsonResource
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
            'job_post_id'=>$this->job_post_id,
            'applicant_id'=>$this->applicant_id,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'job'=>JobResource::make($this->jobPost),
            'applicant'=>ApplicantProfileResource::make($this->applicant),

        ];
    }
}
