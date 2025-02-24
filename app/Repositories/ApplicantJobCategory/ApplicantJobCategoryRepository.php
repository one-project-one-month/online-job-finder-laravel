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
        $applicantProfile->job_categories()->sync($data['job_category_id']);
        return $applicantProfile;
    }

    public function getAll()
    {
        return ApplicantJobCategory::with('applicantProfile', 'jobCategory')->get();
    }

}