<?php

namespace App\Services\ApplicantProfile;

use App\Repositories\ApplicantProfile\ApplicantProfileRepository;

class ApplicantProfileService
{

    protected $applicantProfileRepository;
    public function __construct(ApplicantProfileRepository $applicantProfileRepository)
    {
        $this->applicantProfileRepository = $applicantProfileRepository;
    }

    public function create(array $data)
    {
        return $this->applicantProfileRepository->create($data);
    }

    public function getAll()
    {
        return $this->applicantProfileRepository->getAll();
    }

    public function show($id)
    {

        return $this->applicantProfileRepository->show($id);
    }

    public function  update(array $data, $id)
    {
        return $this->applicantProfileRepository->update($data, $id);
    }

    public function delete($id)
    {

        return $this->applicantProfileRepository->delete($id);
    }
}
