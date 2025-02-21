<?php

namespace App\Http\Controllers\ApplicantEducation;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicantEducationRequest;
use App\Http\Resources\ApplicantEducationResource;
use App\Services\ApplicantEducation\ApplicantEducationService;
use Illuminate\Http\Request;

class ApplicantEducationController extends Controller
{
    protected $applicantEducationService;

    public function __construct(ApplicantEducationService $applicantEducationService)
    {
        $this->applicantEducationService = $applicantEducationService;
    }

    public function index()
    {
        try{
            $applicantEducations = $this->applicantEducationService->getAll();
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Data retrieved Successfully',
                'data' => [
                  'applicantEducations' => ApplicantEducationResource::collection($applicantEducations)
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

    public function store(ApplicantEducationRequest $request)
    {

        try{
            $applicantEducation = $this->applicantEducationService->create($request->toArray());
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Data stored Successfully',
                'data' => [
                  'applicantEducation' =>  new ApplicantEducationResource($applicantEducation)
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
            $applicantEducation = $this->applicantEducationService->show($id);
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Data fetched Successfully',
                'data' => [
                  'applicantEducation' =>  new ApplicantEducationResource($applicantEducation)
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
            $applicantEducation = $this->applicantEducationService->destroy($id);
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Data deleted Successfully',
            ],200);
        } catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'statusCode' => 500,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function update(ApplicantEducationRequest $request,$id)
    {
        try{
            $applicantEducation = $this->applicantEducationService->update($request->toArray(),$id);
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Data updated Successfully',
                'data' => [
                    'applicantEducation' => new ApplicantEducationResource($applicantEducation)
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
