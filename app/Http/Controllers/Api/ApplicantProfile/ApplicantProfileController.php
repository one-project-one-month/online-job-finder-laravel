<?php

namespace App\Http\Controllers\Api\ApplicantProfile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicantProfileRequest;
use App\Http\Requests\ApplicantProfileUpdateRequest;
use App\Http\Requests\UpdateApplicantJobCategoryRequest;
use App\Http\Requests\UpdateApplicantProfileRequest;
use App\Http\Resources\ApplicantProfileResource;
use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\User;
use App\Services\ApplicantProfile\ApplicantProfileService;
use Illuminate\Support\Facades\DB;

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
                'statusCode'=>200,
                'message' => 'Applicant retrives successfully',
                'data' => [
                    'applicantProfiles' => ApplicantProfileResource::collection($applicantProfiles)
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

    public function store(ApplicantProfileRequest $request)
    {

        try {
            $applicantProfile = $this->applicantProfileService->create($request->toArray());
            return response()->json([
                'status' => 'success',
                'statusCode'=>201,
                'message' => "Profile created successfully",
                'data' => [
                    'applicantProfile' => new ApplicantProfileResource($applicantProfile)
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


    public function getMyApplicantProfile(){
        try {
            $user=auth()->user();
            $applicantProfile=$this->applicantProfileService->getMyApplicantProfile($user->id);
            return response()->json(
                [
                    'status' => 'success',
                    'statusCode'=>200,
                    'message' => 'Fetching successfully',
                    'data' => [
                        'applicantProfile' => new ApplicantProfileResource($applicantProfile)
                    ]
                    ],200
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'statusCode'=>500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateMyApplicantProfile(UpdateApplicantProfileRequest $request){
        try {
            $user=auth()->user();
            DB::beginTransaction();
            $this->applicantProfileService->updateMyCompanyProfile($user->id,$request->toArray());
            User::where('id',$user->id)->update([
                'is_activated'=>true,
            ]);

            $applicantProfile=$this->applicantProfileService->getMyApplicantProfile($user->id);

            DB::commit();

            return response()->json(
                [
                    'status' => 'success',
                    'statusCode'=>200,
                    'message' => 'Updated successfully',
                    'data' => [
                        'applicantProfile' => new ApplicantProfileResource($applicantProfile)
                    ]
                    ],200
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'statusCode'=>500,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
