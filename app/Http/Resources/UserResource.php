<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username' => $this->username,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'role_id' => $this->role_id,
            'is_activated' => (bool) $this->is_activated,
            'is_information_completed' => (bool) $this->is_information_completed,
            'profile_photo' => $this->profile_photo,
            'lock_version' => $this->lock_version,
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
            'role' => new RoleResource($this->whenLoaded('role')),
        ];
    }
}
