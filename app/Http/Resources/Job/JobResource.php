<?php

namespace App\Http\Resources\Job;

use App\Http\Resources\JobCategoryResource;
use App\Http\Resources\LocationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'company_id'=>$this->company_id,
            'title'=>$this->title,
            'job_category_id'=>$this->job_category_id,
            'location_id'=>$this->location_id,
            'type'=>$this->type,
            'description'=>$this->description,
            'requirements'=>$this->requirements,
            'num_of_posts'=>$this->num_of_posts,
            'salary'=>$this->salary,
            'address'=>$this->address,
            'status'=>$this->status,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'location'=>LocationResource::make($this->location),
            'jobCategory'=>JobCategoryResource::make($this->jobCategory),


        ];
    }
}
