<?php

namespace App\Repositories\CompanyProfile;
use App\Models\CompanyProfile\CompanyProfile;

class CompanyProfileRepositories
{
    public function create($validatedData)
    {
        $user=auth()->user();
        $validatedData['user_id']=$user->id;
        $existCompanyProfile=CompanyProfile::where('user_id',$user->id)->first();
        logger($existCompanyProfile);
        if ($existCompanyProfile) {
            throw new \Exception("Company profile already created");
        }
        $companyProfile= CompanyProfile::create($validatedData);
        return $companyProfile;


    }

    public function all ()
    {
        // Get all company profiles
        return CompanyProfile::with('location')->get();
    }

    public function find($id)
    {
        // Get company profile by ID
        return CompanyProfile::with('location')->findOrFail($id);
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
