<?php
namespace App\Repositories\CompanyProfile;

use App\Models\CompanyProfile\CompanyProfile;
use App\Models\Job\JobPost;

class CompanyProfileRepository
{
    public function create($validatedData)
    {
        $user                     = auth()->user();
        $validatedData['user_id'] = $user->id;
        $existCompanyProfile      = CompanyProfile::where('user_id', $user->id)->first();
        logger($existCompanyProfile);
        if ($existCompanyProfile) {
            throw new \Exception("Company profile already created");
        }
        $companyProfile = CompanyProfile::create($validatedData);
        return $companyProfile;

    }

    public function all($request)
    {
        // Get all company profiles
        return CompanyProfile::with('location')->get();
    }

    public function getMyCompanyProfile($user_id)
    {
        return CompanyProfile::with(['location'])->where('user_id', $user_id)->first();
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

    public function updateByUserId($user_id, $validatedData)
    {
        $companyProfile = CompanyProfile::where('user_id', $user_id)->first();

        if ($companyProfile) {
            return $companyProfile->update($validatedData);
        }

        $validatedData['user_id'] = $user_id;

        return CompanyProfile::create($validatedData);
    }

    public function delete($id)
    {
        // Delete company profile
        $companyProfile = CompanyProfile::findOrFail($id);
        $companyProfile->delete();

        return $companyProfile;
    }

    public function getJobs($id){
        $jobs=JobPost::with('company','jobCategory','location')->where('company_id',$id)->get();
        return $jobs;
    }
}
