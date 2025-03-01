<?php

namespace App\Http\Controllers\ApplicantEducation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ApplicantEducationRequest;
use App\Http\Resources\ApplicantEducationResource;
use App\Services\ApplicantEducation\ApplicantEducationService;

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
            if (Gate::denies('delete', $id)) {
                return response()->json([
                    'message'    => 'Unauthorized action',
                    'status'     => 'error',
                    'statusCode' => 403,
                ], 403);
            }
            $applicantEducation = $this->applicantEducationService->destroy($id);
            return response()->json([
            ],204);
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
            if (Gate::denies('update', $id)) {
                return response()->json([
                    'message'    => 'Unauthorized action',
                    'status'     => 'error',
                    'statusCode' => 403,
                ], 403);
            }
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
