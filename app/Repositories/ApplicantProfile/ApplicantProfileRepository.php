<?php

namespace App\Repositories\ApplicantProfile;

use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\CompanyProfile\CompanyProfile;

class ApplicantProfileRepository
{
    public function create(array $data)
    {
        return ApplicantProfile::create($data);
    }

    public function getAll()
    {
        return ApplicantProfile::with('location')->latest()->get();
    }

    public function show($id)
    {
        return ApplicantProfile::with('location')->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $applicantProfile = ApplicantProfile::findOrFail($id);
        $applicantProfile->update($data);
        return $applicantProfile;
    }

    public function delete($id)
    {
        $applicantProfile = ApplicantProfile::findOrFail($id);
        $applicantProfile->delete();
        return $applicantProfile;
    }

    public function getMyApplicantProfile($user_id){
        return ApplicantProfile::with('location')->where('user_id',$user_id)->first();
    }

    public function updateMyApplicantProfile($user_id,$data){
        $applicantProfile=ApplicantProfile::where('user_id',$user_id)->first();

        if ($applicantProfile) {
           return $applicantProfile->update($data);
        }

        $data['user_id']=$user_id;

        return ApplicantProfile::create($data);
    }
}
