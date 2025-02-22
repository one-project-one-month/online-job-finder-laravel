<?php

namespace App\Repositories\ApplicantSkills;

use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\ApplicantSkills\ApplicantSkill;
use Illuminate\Support\Facades\Auth;

class ApplicantSkillRepository
{
    public function create( $data)
    {
        $user_id = Auth::user()->id;

        $applicantProfile = ApplicantProfile::where('user_id', $user_id)->firstOrFail();
        if (ApplicantSkill::where('applicant_id', $applicantProfile->id)->exists()) {
            throw new \Exception("Applicant skills already created");
        }
        $applicantProfile->skills()->sync($data['skill_ids']);


        return ApplicantSkill::where('applicant_id',$applicantProfile->id)->with('applicantProfile','skill')->get();

    }

    public function getAll()
    {
        $user=auth()->user();
        $applicant=ApplicantProfile::where('user_id',$user->id)->first();
        return ApplicantSkill::where('applicant_id',$applicant->id)->with('applicantProfile','skill')->get();
    }

    public function show($id)
    {
        return ApplicantSkill::with('skill','applicantProfile')->findOrFail($id);
    }

    public function update($data, $id)
    {
        $user_id = Auth::user()->id;
        $applicantProfile = ApplicantProfile::where('user_id', $user_id)->firstOrFail();
        $applicantProfile->skills()->sync($data['skill_ids']);
        return ApplicantSkill::where('applicant_id',$applicantProfile->id)->with('applicantProfile','skill')->get();
    }

    public function delete($id)
    {

        $applicantSkill = ApplicantSkill::where('applicant_id',$id)->firstOrFail();
        $applicantSkill->delete();
        return $applicantSkill;
    }
}
