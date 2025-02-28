<?php

// app/Http/Resources/JobCategoryResource.php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;



class JobCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'lock_version' => $this->lock_version,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
