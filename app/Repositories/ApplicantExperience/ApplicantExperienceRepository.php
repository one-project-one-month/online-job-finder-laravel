<?php

namespace App\Repositories\ApplicantExperience;

use Carbon\Carbon;
use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\ApplicantExperience\ApplicantExperience;

class ApplicantExperienceRepository
{
    public function create(array $data){
        $user = auth()->user();
        $applicant = ApplicantProfile::where('user_id',$user->id)->first();

        if (isset($data['start_date'])) {
            $data['start_date'] =  Carbon::parse($data['start_date'])->toDateString();
        }

        if (isset($data['end_date'])) {
            $data['end_date'] =  Carbon::parse($data['end_date'])->toDateString();
        }
        $data['applicant_id'] = $applicant->id;
        $ApplicantExperience=ApplicantExperience::where('applicant_id',$applicant->id)->first();
        if ($ApplicantExperience) {
            throw new \Exception("Applicant experience already created");
        }

      return  ApplicantExperience::create($data);

    }

    public function update(array $data,$id){
        $ApplicantExperience = ApplicantExperience::findOrFail($id);
        if (isset($data['start_date'])) {
            $data['start_date'] =  Carbon::parse($data['start_date'])->toDateString();
        }

        if (isset($data['end_date'])) {
            $data['end_date'] =  Carbon::parse($data['end_date'])->toDateString();
        }
        $ApplicantExperience->update($data);
        return $ApplicantExperience;
    }

    public function delete($id){
        $ApplicantExperience = ApplicantExperience::findOrFail($id);
        $ApplicantExperience->delete();
        return $ApplicantExperience;
    }

    public function show($id){
        return ApplicantExperience::findOrFail($id);
    }

    public function getAll(){
        $ApplicantExperiences = ApplicantExperience::latest()->get();
        return $ApplicantExperiences;
    }

}
