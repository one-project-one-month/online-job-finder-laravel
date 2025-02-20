<?php

namespace App\Repositories\ApplicantSkills;

use App\Models\ApplicantSkills\ApplicantSkill;
use Illuminate\Support\Facades\Auth;

class ApplicantSkillRepository
{
    public function create( $data)
    {
        $user_id = Auth::user()->id;
        $data['applicant_id'] = $user_id;
        return ApplicantSkill::create(['applicant_id' => $data->applicant_id , 'skill_id' => $data->skill_id]);
    }

    public function getall()
    {
        return ApplicantSkill::with('skill')->get();
    }

    public function show($id)
    {
        return ApplicantSkill::findOrFail($id);
    }

    public function update( $data, $id)
    {
        $user_id = Auth::user()->id;
        $data['applicant_id'] = $user_id;
        
        $applicantSkill = ApplicantSkill::with('skill')->findOrFail($id);
        $applicantSkill->update(['applicant_id' => $data->applicant_id,'skill_id' => $data->skill_id]);
        return $applicantSkill;

        
    }

    public function delete($id)
    {
        $applicantSkill = ApplicantSkill::findOrFail($id);
        $applicantSkill->delete();
        return $applicantSkill;
    }
}
