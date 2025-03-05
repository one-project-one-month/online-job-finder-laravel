<?php

namespace App\Services\JobList;

use App\Repositories\JobList\JobListRepository;

class JobListService{

    protected $jobListRepo;

    public function __construct(JobListRepository $jobListRepo){
        $this->jobListRepo=$jobListRepo;
    }

    public function getAllJobs(){
        return $this->jobListRepo->getAllJobs();
    }

    public function getJobById($id){
        return $this->jobListRepo->getJob($id);
    }


}
