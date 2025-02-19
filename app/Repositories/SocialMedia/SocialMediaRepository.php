<?php


namespace App\Repositories\SocialMedia;

use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\CompanyProfile\CompanyProfile;
use App\Models\SocialMedia\SocialMedia;

class SocialMediaRepository{
     public function index(){
        return SocialMedia::get();
     }

     public function create($data){

         $socialMedia= SocialMedia::create($data);
        return $socialMedia;
     }

     public function find($id){
        $socialMedia= SocialMedia::findOrFail($id);
        return $socialMedia;
     }

     public function update($data,$id){

        $socialMedia=SocialMedia::findOrFail($id);
        $socialMedia->update($data);
        return $socialMedia;
     }

     public function delete($id){
        $socialMedia=SocialMedia::findOrFail($id);
        $socialMedia->delete();
        return $socialMedia;
     }
}
