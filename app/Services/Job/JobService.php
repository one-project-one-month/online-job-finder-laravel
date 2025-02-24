<?php

namespace App\Services\Job;

use App\Models\CompanyProfile\CompanyProfile;
use App\Repositories\Job\JobRepository;

class JobService{

    protected $jobRepo;
    public function __construct(JobRepository $jobRepo){
        $this->jobRepo=$jobRepo;
    }

    public function getAllJobs(){
        return $this->jobRepo->get();
    }

    public function createJob($data){
        return $this->jobRepo->createJob($data);
    }

    public function showJobById($id){
        return $this->jobRepo->show($id);
    }

    public function updateJob($data,$id){
        return $this->jobRepo->update($data,$id);
    }

    public function deleteJob($id){
        return $this->jobRepo->delete($id);
    }


}
