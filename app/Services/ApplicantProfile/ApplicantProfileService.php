<?php

namespace App\Services\ApplicantProfile;

use App\Models\ApplicantProfile\ApplicantProfile;
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
        $user=auth()->user();
        $data['user_id']=$user->id;

        $existApplicantProfile=ApplicantProfile::where('user_id',$user->id)->first();
        if ($existApplicantProfile) {
            throw new \Exception("Applicant profile already created");
        }
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

    public function getMyApplicantProfile($user_id){
        return $this->applicantProfileRepository->getMyApplicantProfile($user_id);
    }

    public function updateMyCompanyProfile($user_id,$data){
        return $this->applicantProfileRepository->updateMyApplicantProfile($user_id,$data);
    }
}
