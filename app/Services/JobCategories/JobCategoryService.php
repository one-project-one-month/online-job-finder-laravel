<?php

// app/Services/JobCategoryService.php

namespace App\Services\JobCategories;

use App\Repositories\JobCategory\JobCategoryRepository;


class JobCategoryService
{
    protected $jobCategoryRepo;

    public function __construct(JobCategoryRepository $jobCategoryRepo)
    {
        $this->jobCategoryRepo = $jobCategoryRepo;
    }

    public function createJobCategory(array $data)
    {
        return $this->jobCategoryRepo->create($data); // Calls the repository to create a new JobCategory
    }

    public function getAllJobCategories()
    {
        return $this->jobCategoryRepo->all(); // Calls the repository to get all JobCategories
    }

    public function getJobCategory($id)
    {
        return $this->jobCategoryRepo->find($id); // Calls the repository to get JobCategory by id
    }

    public function updateJobCategory(array $data, $id)
    {
        return $this->jobCategoryRepo->update($data, $id);

    }

    public function deleteJobCategory($id){
        return $this->jobCategoryRepo->delete($id);
    }

}
