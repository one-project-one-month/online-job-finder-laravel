<?php

namespace App\Repositories\ApplicantProfile;

use App\Models\ApplicantProfile\ApplicantProfile;

class ApplicantProfileRepository
{
    public function create(array $data)
    {
        return ApplicantProfile::create($data);
    }

    public function getall()
    {
        return ApplicantProfile::latest()->get();
    }

    public function show($id)
    {
        return ApplicantProfile::findOrFail($id);
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
}
