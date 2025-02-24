<?php

namespace App\Repositories\Job;

use App\Models\Job\Job;
use App\Models\CompanyProfile\CompanyProfile;
use App\Models\Job\JobPost;

class JobRepository{
    public function get(){
        $jobs=JobPost::when(request('location'),function($query){
           $query->whereHas('location',function($query){
                return $query->where('id',request('location'));
            });
        })->
        when(request('jobCategory'),function($query){
            $query->whereHas('location',function($query){
                return $query->where('id',request('jobCategory'));
            });
        })->get();
        dd($jobs);
        return $jobs;
    }

    public function createJob($data){

        $user=auth()->user();
        $company=CompanyProfile::where('user_id',$user->id)->first();
        if (!$company) {
            throw new \Exception("Company profile not found for this user.");
        }
        $data['company_id']=$company->id;
        logger($data);
        $job=JobPost::create($data);
       return $job;
    }

    public function show($id){
        $job=JobPost::findOrFail($id);
        return $job;
    }

    public function update($data,$id){
        $job=JobPost::findOrFail($id);
        $job->update($data);
        return $job;
    }

    public function delete($id){
        $job=JobPost::findOrFail($id);
        $job->delete();
        return $job;
    }
}
