<?php

namespace App\Http\Controllers\Api\ApplicantSkill;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicantSkillRequest;
use App\Http\Requests\UpdateApplicantSkillRequest;
use App\Http\Resources\ApplicantSkillResource;
use App\Services\ApplicantSkills\ApplicantSkillService;
use Illuminate\Support\Facades\Auth;

class ApplicantSkillController extends Controller
{
    private $applicantSkillService;

    public function __construct(ApplicantSkillService $applicantSkillService)
    {
        $this->applicantSkillService = $applicantSkillService;
    }

    public function index()
    {
        try {
            $applicantSkills = $this->applicantSkillService->getAll();
            return response()->json([
                'status' => 'success',
                'statusCode'=>200,
                'message' => 'Applicant-skills retrives successfully',
                'data' => [
                    'applicantSkills' => ApplicantSkillResource::collection($applicantSkills)
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'statusCode'=>500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreApplicantSkillRequest $request)
    {
        try {
            $this->applicantSkillService->create($request->toArray());
            
            return response()->json([
                'status' => 'success',
                'statusCode'=>201,
                'message' => "Applicant-skill created successfully",
                'data' => [
                    // 'applicantSkill' => new ApplicantSkillResource($applicantSkill)
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'statusCode'=>500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $applicantSkillId = $this->applicantSkillService->show($id);
            return response()->json([
                'status' => 'success',
                'statusCode'=>200,
                'message' => "fetching success",
                'data' => [
                    'applicantSkill' => new ApplicantSkillResource($applicantSkillId)
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'statusCode'=>500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateApplicantSkillRequest $request,$id)
    {
        
        try {
             $applicantSkill = $this->applicantSkillService->update($request, $id);
           
            return response()->json(
                [
                    'status' => 'success',
                    'statusCode'=>200,
                    'message' => 'Applicant-skill updated successfully',
                    'data' => [
                        'applicantSkill' => new ApplicantSkillResource($applicantSkill)
                    ]
                ]
            );
        }
        catch (\Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'status' => 'fail to update',
                    'statusCode'=>500
                ],
                500
            );
        }
    }

    public function destroy($id)
    {
        try {
            $this->applicantSkillService->delete($id);
            return response()->json([
                'status' => 'success',
                'message' => 'deleted successful',
                'statusCode'=>200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail to delete',
                'statusCode'=>500,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
