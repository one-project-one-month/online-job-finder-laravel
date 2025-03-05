<?php

namespace App\Repositories\JobList;

use App\Models\Job\JobPost;

class JobListRepository{

    public function getAllJobs(){
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
        ->latest()->get();

        return $jobs;
    }

    public function getJob($id){
        $job=JobPost::findOrFail($id);
        return $job;
    }
}
