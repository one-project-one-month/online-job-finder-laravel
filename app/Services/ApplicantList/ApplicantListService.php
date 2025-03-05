<?php

namespace App\Services\ApplicantList;

use App\Repositories\ApplicantList\ApplicantListRepository;

class ApplicantListService{

    protected $applicantListRepo;

    public function __construct(ApplicantListRepository $applicantListRepo){
        $this->applicantListRepo=$applicantListRepo;
    }

    public function getApplicantList(){
        return $this->applicantListRepo->getApplicantList();
    }

    public function getApplicantById($id){
        return $this->applicantListRepo->getApplicant($id);
    }
}
