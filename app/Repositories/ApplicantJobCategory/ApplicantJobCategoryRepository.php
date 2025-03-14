<?php

namespace App\Repositories\ApplicantJobCategory;

use Illuminate\Support\Facades\Auth;
use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\ApplicantJobCategory\ApplicantJobCategory;

class ApplicantJobCategoryRepository
{
    public function create ($data)
    {
        $user_id = Auth::user()->id;
        $applicantProfile = ApplicantProfile::where('user_id', $user_id)->firstOrFail();
       
        $applicantProfile->job_categories()->sync($data['job_category_ids']);

        return ApplicantJobCategory::where('applicant_id', $applicantProfile->id)
                           ->with('applicantProfile', 'jobCategory')
                           ->get();
    }

    public function getAll()
    {
        $user = auth()->user();
        $applicant = ApplicantProfile::where('user_id', $user->id)->firstOrFail();
        return ApplicantJobCategory::where('applicant_id', $applicant->id)->with('applicantProfile', 'jobCategory')->get();
    }


    public function show($id)
    {
        return ApplicantJobCategory::with('jobCategory','applicantProfile')->findOrFail($id);
    }


    public function update($data, $id)
    {
        $applicantProfile = ApplicantProfile::where('id', $id)->firstOrFail();
        $applicantProfile->job_categories()->sync($data['job_category_ids']);
        return ApplicantJobCategory::where('applicant_id',$applicantProfile->id)->with('applicantProfile','jobCategory')->get();
    }

    public function delete($id)
    {
        $applicantProfile = ApplicantJobCategory::where('applicant_id',$id)->firstOrFail();
        $applicantProfile->delete();
        return $applicantProfile;
    }
}


