<?php

namespace App\Http\Controllers\Api\SavedJob;

use App\Http\Controllers\Controller;
use App\Http\Requests\SavedJob\SavedJobRequest;
use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\SavedJob\SavedJob;
use Illuminate\Http\Request;

class SavedJobController extends Controller
{


    public function toggleSaveJob(SavedJobRequest $request){
        $user=auth()->user();
        $applicant=ApplicantProfile::where('user_id',$user->id)->first();
        $saveJob=SavedJob::where('job_post_id',$request->job_post_id)->first();

        if ($saveJob) {
            $saveJob->delete();
            return response()->json([
                'message'=>'job unsaved successfully',
                'status'=>'success',
                'statusCode'=>200,
            ],200);
        }else{
           SavedJob::create([
            'job_post_id'=>$request->job_post_id,
            'applicant_id'=>$applicant->id
           ]);

           return response()->json([
            'message'=>'job saved',
            'status'=>'success',
            'statusCode'=>201
           ],201);
        }
    }
}
