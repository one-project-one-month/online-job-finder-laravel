<?php

namespace App\Services\ApplicantJobCategory;

use App\Repositories\ApplicantJobCategory\ApplicantJobCategoryRepository;

class ApplicantJobCategoryService
{
    protected $applicantJobCategoryRepository;

    public function __construct(ApplicantJobCategoryRepository $applicantJobCategoryRepository)
    {
        $this->applicantJobCategoryRepository = $applicantJobCategoryRepository;
    }

    public function create($data)
    {
        return $this->applicantJobCategoryRepository->create($data);
    }

    public function getAll()
    {
        return $this->applicantJobCategoryRepository->getAll();
    }

    public function show($id)
    {
        return $this->applicantJobCategoryRepository->show($id);
    }

    public function update($data, $id)
    {
        return $this->applicantJobCategoryRepository->update($data,$id);
    }

    public function delete ($id)
    {
        return $this->applicantJobCategoryRepository->delete($id);
    }
}