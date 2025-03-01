<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'user_id'      => $this->user_id,
            'fullName'     => $this->full_name,
            'phone'        => $this->phone,
            'address'      => $this->address,
            'location_id'  => $this->location_id,
            'description'  => $this->description,
            'lock_version' => $this->lock_version,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
            'location'     => new LocationResource($this->location),
        ];
    }
}
