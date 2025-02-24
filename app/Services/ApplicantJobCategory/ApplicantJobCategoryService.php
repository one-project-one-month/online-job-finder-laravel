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
}