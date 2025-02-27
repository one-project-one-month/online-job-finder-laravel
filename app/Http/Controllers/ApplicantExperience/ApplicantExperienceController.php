<?php

namespace App\Http\Controllers\ApplicantExperience;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicantExperienceRequest;
use App\Http\Resources\ApplicantEducationResource;
use App\Services\ApplicantExperience\ApplicantExperienceService;
use Illuminate\Http\Request;

class ApplicantExperienceController extends Controller
{
    protected $applicantExperienceService;

    public function __construct(ApplicantExperienceService $applicantExperienceService)
    {
        $this->applicantExperienceService = $applicantExperienceService;
    }

    public function index()
    {
        try{
            $applicantExperience = $this->applicantExperienceService->getAll();
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Data retrieved Successfully',
                'data' => [
                  'applicantExperience' => new ApplicantEducationResource($applicantExperience)
                ]
                ],200);
        } catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'statusCode' => 500,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function store(ApplicantExperienceRequest $request)
    {
        try {
            $applicantExperience = $this->applicantExperienceService->create($request->toArray());
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Data stored Successfully',
                'data' => [
                  'applicantExperience' => new ApplicantExperienceResource($applicantExperience)
                ]
            ],200);
        } catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'statusCode' => 500,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function show($id)
    {
        try{
            $applicantExperience = $this->applicantExperienceService->show($id);
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Data retrieved Successfully',
                'data' => [
                  'applicantExperience' => new ApplicantExperienceResource($applicantExperience)
                ]
                ],200);
        } catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'statusCode' => 500,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function destroy($id)
    {
        try{
            $applicantExperience = $this->applicantExperienceService->destroy($id);
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Data deleted Successfully',
                'data' => [
                  'applicantExperience' => new ApplicantExperienceResource($applicantExperience)
                ]
                ],200);
        } catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'statusCode' => 500,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function update(ApplicantExperienceRequest $request, $id)
    {
        try{
            $applicantExperience = $this->applicantExperienceService->update($request->toArray(),$id);
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Data updated Successfully',
                'data' => [
                  'applicantExperience' => new ApplicantExperienceResource($applicantExperience)
                ]
                ],200);
        } catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'statusCode' => 500,
                'message' => $e->getMessage()
            ],500);
        }
    }

}
