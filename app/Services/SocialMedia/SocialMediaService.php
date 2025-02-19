<?php

namespace App\Services\SocialMedia;

use App\Models\CompanyProfile\CompanyProfile;
use App\Models\ApplicantProfile\ApplicantProfile;
use App\Repositories\SocialMedia\SocialMediaRepository;

class SocialMediaService{

    protected $socialMediaRepo;

    public function __construct(SocialMediaRepository $socialMediaRepo){
        $this->socialMediaRepo=$socialMediaRepo;
    }

    public function getAllSocialMedia(){
        return $this->socialMediaRepo->index();
    }

    public function createSocialMedia($data){
        $userId=auth()->user()->id;
        $profile=ApplicantProfile::where('user_id',$userId)->first();
        if (!$profile) {
            $profile=CompanyProfile::where('user_id',$userId)->first();
        }
        if (!$profile) {
            return response()->json(['message' => 'Profile not found for this user'], 404);
        }
        $data['profile_id']=$profile->id;
        return $this->socialMediaRepo->create($data);
    }

    public function getSocialMediaById($id){
        return $this->socialMediaRepo->find($id);
    }

    public function updateSocialMedia($data,$id){
        $userId=auth()->user()->id;
        $profile=ApplicantProfile::where('user_id',$userId)->first();
        if (!$profile) {
            $profile=CompanyProfile::where('user_id',$userId)->first();
        }
        if (!$profile) {
            return response()->json(['message' => 'Profile not found for this user'], 404);
        }
        $data['profile_id']=$profile->id;
        return $this->socialMediaRepo->update($data,$id);
    }

    public function deleteSocialMedia($id){
        return $this->socialMediaRepo->delete($id);
    }
}
