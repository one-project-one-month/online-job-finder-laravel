<?php

// app/Repositories/JobCategoryRepository.php

namespace App\Repositories\JobCategory;



use App\Models\JobCategory\JobCategory;

class JobCategoryRepository
{
    public function create(array $data)
    {
        return JobCategory::create($data);
    }

    public function all()
    {
        return JobCategory::latest()->get();
    }

    public function find($id)
    {
        return JobCategory::findOrFail($id);
    }

    public function update(array $data , $id){
        $jobCategory = JobCategory::findOrFail($id);
        $jobCategory->update($data);
        return $jobCategory;
    }

    public function delete($id){
        $jobCategory=JobCategory::findOrFail($id);
        $jobCategory->delete();
        return $jobCategory;
    }

}
