<?php
namespace App\Http\Resources\Review;

use App\Http\Resources\ApplicantProfileResource;
use App\Http\Resources\CompanyProfileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'rating'     => $this->rating,
            'comment'    => $this->comment,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'applicant'  => ApplicantProfileResource::make($this->whenLoaded('applicant')),
            // 'company'    => CompanyProfileResource::make($this->whenLoaded('company')),
        ];
    }
}
