<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'companyName' => $this->company_name,
            'phone'       => $this->phone,
            'website'     => $this->website,
            'address'     => $this->address,
            'description' => $this->description,
            'createdAt'   => $this->created_at,
            'updatedAt'   => $this->updated_at,
            'location'    => new LocationResource($this->whenLoaded('location')),
        ];
    }
}
