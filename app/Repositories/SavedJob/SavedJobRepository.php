<?php

namespace App\Repositories\SavedJob;

use App\Models\SavedJob\SavedJob;
use App\Models\ApplicantProfile\ApplicantProfile;

class SavedJobRepository{

    public function savedJobs(){
        $user=auth()->user();
        $applicant=ApplicantProfile::where('user_id',$user->id)->first();
        $saveJobs=SavedJob::where('applicant_id',$applicant->id)->latest()->get();
        return $saveJobs;
    }
}
