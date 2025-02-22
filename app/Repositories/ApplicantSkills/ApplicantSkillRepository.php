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
        // $data['applicant_id'] = $user_id;
        // return ApplicantSkill::create(['applicant_id' => $data->applicant_id , 'skill_id' => $data->skill_id]);

        $applicantProfile = ApplicantProfile::where('user_id', $user_id)->firstOrFail();

        // foreach ($data as $key => $value) {
        //     ApplicantSkill::create([
        //         'applicant_id' => $applicantProfile->id,
        //         'skill_id' => $value
        //     ]);
        // }
        $applicantProfile->skills()->sync($data['skill_ids']);
        return $applicantProfile;
    }

    public function getAll()
    {
        return ApplicantSkill::with('applicantProfile','skill')->get();
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
        return ApplicantSkill::with('skill')->findOrFail($id);
    }

    public function delete($id)
    {
        $applicantSkill = ApplicantSkill::findOrFail($id);
        $applicantSkill->delete();
        return $applicantSkill;
    }
}
