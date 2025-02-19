<?php

namespace App\Repositories\ApplicantSkills;

use App\Models\ApplicantSkills\ApplicantSkill;

class ApplicantSkillRepository
{
    public function create(array $data)
    {
        return ApplicantSkill::create($data);
    }

    public function getall()
    {
        return ApplicantSkill::with('skill')->get();
    }

    public function show($id)
    {
        return ApplicantSkill::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $applicantSkill = ApplicantSkill::findOrFail($id);
        $applicantSkill->update($data);
        return $applicantSkill;
    }

    public function delete($id)
    {
        $applicantSkill = ApplicantSkill::findOrFail($id);
        $applicantSkill->delete();
        return $applicantSkill;
    }
}
