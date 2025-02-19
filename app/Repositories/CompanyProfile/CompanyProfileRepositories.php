<?php

namespace App\Repositories\CompanyProfile;
use App\Models\CompanyProfile\CompanyProfile;

class CompanyProfileRepositories
{
    public function create($validatedData)
    {
        // Create and save a new company profile
        return CompanyProfile::create($validatedData);
    }

    public function all ()
    {
        // Get all company profiles
        return CompanyProfile::with('location')->get();
    }

    public function find($id)
    {
        // Get company profile by ID
        return CompanyProfile::find($id);
    }

    public function update($validatedData, $id)
    {
        // Update company profile
        $companyProfile = CompanyProfile::findOrFail($id);
        $companyProfile->update($validatedData);

        return $companyProfile;
    }

    public function delete($id)
    {
        // Delete company profile
        $companyProfile = CompanyProfile::findOrFail($id);
        $companyProfile->delete();

        return $companyProfile;
    }
}
