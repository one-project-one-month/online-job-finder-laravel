<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantExperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'applicant_id' => $this->applicant_id,
            'company_name' => $this->company_name,
            'location' => $this->location,
            'title' => $this->title,
            'description' => $this->description,
            'job_type' => $this->job_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date ? $this->end_date : null,
            'currently_working' => $this->currently_working,
            'lock_version' => $this->lock_version,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'applicant'=>ApplicantProfileResource::make($this->applicant)
        ];
    }
}
