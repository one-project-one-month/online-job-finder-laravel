<?php

namespace App\Http\Controllers\Api\ApplicantProfile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicantProfileRequest;
use App\Http\Resources\ApplicantProfileResource;
use App\Models\ApplicantProfile\ApplicantProfile;
use App\Services\ApplicantProfile\ApplicantProfileService;

class ApplicantProfileController extends Controller
{
    private $applicantProfileService;

    public function __construct(ApplicantProfileService $applicantProfileService)
    {
        $this->applicantProfileService = $applicantProfileService;
    }

    public function index()
    {
        try {
            $applicantProfiles = $this->applicantProfileService->getAll();
            return response()->json([
                'status' => 'success',
                'message' => 'Applicant retrives successfully',
                'data' => [
                    'applicantProfiles' => ApplicantProfileResource::collection($applicantProfiles)
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(ApplicantProfileRequest $request)
    {
        try {
            $applicantProfile = $this->applicantProfileService->create($request->toArray());
            return response()->json([
                'status' => 'success',
                'message' => "Profile created successfully",
                'data' => [
                    'applicantProfile' => new ApplicantProfileResource($applicantProfile)
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $applicantProfileId = $this->applicantProfileService->show($id);
            return response()->json([
                'status' => 'success',
                'message' => "fetching success",
                'data' => [
                    'applicantProfile' => new ApplicantProfileResource($applicantProfileId)
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(ApplicantProfileRequest $request,$id)
    {

        try {
            logger($id);
            $applicantProfile = $this->applicantProfileService->update($request->toArray(), $id);

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Profile updated successfully',
                    'data' => [
                        'applicantProfile' => new ApplicantProfileResource($applicantProfile)
                    ]
                ]
            );
        }
        catch (\Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'status' => 'fail to update'
                ],
                500
            );
        }
    }

    public function destroy(ApplicantProfile $applicantProfile)
    {
        try {
            $this->applicantProfileService->delete($applicantProfile->id);
            return response()->json([
                'status' => 'success',
                'message' => 'deleted successful',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail to delete',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
