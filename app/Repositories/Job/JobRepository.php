<?php

namespace App\Repositories\Job;

use App\Models\Application\Application;
use App\Models\Job\Job;
use App\Models\CompanyProfile\CompanyProfile;
use App\Models\Job\JobPost;

class JobRepository{
    public function getJobsByCompanyId($company_id){
        $jobs=JobPost::where('company_id',$company_id)->get();
        return $jobs;
    }

    public function createJob($data){

        $user=auth()->user();
        $company=CompanyProfile::where('user_id',$user->id)->first();
        if (!$company) {
            throw new \Exception("Company profile not found for this user.");
        }
        $data['company_id']=$company->id;

        $skills=$data['skill_ids'] ?? [];

        $job=JobPost::create($data);

        if (!empty($skills)) {
            $job->skills()->sync($skills);
        }

       return $job;
    }

    public function show($id){
        $job=JobPost::findOrFail($id);
        return $job;
    }

    public function update($data,$id){
        $job=JobPost::findOrFail($id);
        $skills=$data['skill_ids'] ?? [];
        $job->update($data);

        if (!empty($skills)) {
            $job->skills()->sync($skills);
        }

        return $job;
    }

    public function delete($id){
        $job=JobPost::findOrFail($id);
        $job->delete();
        return $job;
    }

    public function getApplicationsById($id){
        $jobApplications=Application::where('job_post_id',$id)->get();
        return $jobApplications;
    }
    public function getShortList($id){
        $shortListApplications=Application::where('status','Accepted')->where('job_post_id',$id)->get();
        return $shortListApplications;
    }
}
