<?php

namespace App\Repositories\ApplicantList;

use App\Models\ApplicantProfile\ApplicantProfile;

class ApplicantListRepository{

    public function getApplicantList(){
        $applicantList = ApplicantProfile::when(!empty(request('search')), function ($query) {
            return $query->where('full_name', 'like', '%' . request('search') . '%');
        })->with('location')->get();
        return $applicantList;
    }

    public function getApplicant($id){
        $applicant=ApplicantProfile::where('id',$id)->with('location')->first();
        return $applicant;
    }
}
