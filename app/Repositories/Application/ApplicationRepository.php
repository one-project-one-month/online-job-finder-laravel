<?php

namespace App\Repositories\Application;

use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\Application\Application;
use Carbon\Carbon;

class ApplicationRepository{

    public function create($data){
        $user=auth()->user();
        $applicant=ApplicantProfile::where('user_id',$user->id)->first();
        if (!$applicant) {
            throw new \Exception("Applicant user is not found");
        }

        $data['applicant_id']=$applicant->id;
        $applicantId=Application::where('applicant_id',$data['applicant_id'])->first();
        if ($applicantId) {
            throw new \Exception("already applied");
        }
        $data['applied_at']=Carbon::now();
        $application=Application::create($data);
        return $application;
    }

    public function get(){
        $applicant=ApplicantProfile::where('user_id',auth()->user()->id)->first();

        $applications=Application::where('applicant_id',$applicant->id)->get();
        return $applications;
    }

    public function show($id){
        $application=Application::findOrFail($id);
        return $application;
    }

    public function update($data,$id){
        $application=Application::findOrFail($id);
        $application->update($data);
        return $application;
    }

    public function delete($id){
        $application=Application::findOrFail($id);
        $application->delete();
        return $application;
    }

    public function updateStatus($data,$id){
        $updateStatus=Application::findOrFail($id);
        if (is_array($data)) {
            $data = reset($data);
        }
        $updateStatus->update([
            'status'=>$data
        ]);
        return $updateStatus;
    }


}
