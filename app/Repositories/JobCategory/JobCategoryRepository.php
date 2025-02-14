<?php

// app/Repositories/JobCategoryRepository.php

namespace App\Repositories\JobCategory;



use App\Models\JobCategory\JobCategory;

class JobCategoryRepository
{
    public function create(array $data)
    {
        return JobCategory::create($data); // Creates a new JobCategory record
    }

    public function all()
    {
        return JobCategory::all(); // Returns all JobCategory records
    }

    public function find($id)
    {
        return JobCategory::findOrFail($id); // Returns JobCategory record by id
    }
    
}
