<?php

namespace App\Repositories\Job;

use App\Models\Job\Job;
use App\Models\CompanyProfile\CompanyProfile;
use App\Models\Job\JobPost;

class JobRepository{
    public function get(){
        $jobs=JobPost::when(request('location'),function($query){
            return $query->where('location_id',request('location'));
        })->
        when(request('jobCategory'),function($query){
            return $query->where('job_category_id',request('jobCategory'));
        })->
        when(request('type'),function($query){
            return $query->where('type',request('type'));
        })->
        when(request('search'),function($query){
            return $query->where('title','like','%'.request('search').'%');
        })
        ->
        when(request('company'),function($query){
            return $query->where('company_id',request('company'));
        })
        ->get();

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
}
