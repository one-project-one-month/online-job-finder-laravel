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
            'id' => $this->id,
            'user_id'=>$this->user_id,
            'company_name' => $this->company_name,
            'phone' => $this->phone,
            'website' => $this->website,
            'address' => $this->address,
            'location_id' => $this->location_id,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'location'=>new LocationResource($this->whenLoaded('location'))
        ];
    }
}
