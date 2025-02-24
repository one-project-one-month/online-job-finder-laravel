<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantJobCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'applicant_id' => $this->applicant_id,
            'applicant_name' => $this->applicantProfile->full_name ?? 'Unknown',
            'lock_version' => $this->lock_version,
            'job_category_id' => $this->job_category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // Include related models using whenLoaded for better performance
            'jobCategory' => new JobCategoryResource($this->whenLoaded('jobCategory')),
            'applicant' => new ApplicantProfileResource($this->whenLoaded('applicantProfile')),
        ];
    }
}
