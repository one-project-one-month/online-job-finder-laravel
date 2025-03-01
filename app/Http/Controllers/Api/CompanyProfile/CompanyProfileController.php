<?php
namespace App\Http\Controllers\Api\CompanyProfile;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyProfileRequest;
use App\Http\Resources\CompanyProfileResource;
use App\Http\Resources\Review\ReviewResource;
use App\Models\CompanyProfile\CompanyProfile;
use App\Services\CompanyProfile\CompanyProfileServices;
use App\Services\Review\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
    private $companyProfileService;
    private $reviewService;

    public function __construct(CompanyProfileServices $companyProfileService, ReviewService $reviewService)
    {
        $this->companyProfileService = $companyProfileService;
        $this->reviewService         = $reviewService;
    }

    public function index(Request $request)
    {
        try {
            $companies = $this->companyProfileService->GetAllCompanyProfile($request);

            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'fetching successful',
                'data'       => [
                    'companies' => CompanyProfileResource::collection($companies),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'error',
                'message'    => $e->getMessage(),
                'statusCode' => 500,
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $companyProfile = $this->companyProfileService->getCompanyProfileById($id);
            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'fetching successful',
                'data'       => [
                    'companyProfile' => new CompanyProfileResource($companyProfile),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'error',
                'message'    => $e->getMessage(),
                'statusCode' => 500,
            ], 500);
        }
    }

    public function getJobs(Request $request)
    {

    }

    public function store(CompanyProfileRequest $request)
    {
        try {
            $companyProfile = $this->companyProfileService->createCompanyProfile($request->toArray());

            return response()->json(
                [
                    'status'     => 'success',
                    'statusCode' => 201,
                    'message'    => 'Company Profile created successfully',
                    'data'       => [
                        'CompanyProfile' => new CompanyProfileResource($companyProfile),
                    ],
                ], 201
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message'    => $e->getMessage(),
                    'status'     => 'error',
                    'statusCode' => 500,
                ], 500
            );
        }
    }

    public function getMyCompanyProfile()
    {
        try {
            $user = Auth::user();

            $companyProfile = $this->companyProfileService->getMyCompanyProfile($user->id);

            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'fetching successful',
                'data'       => [
                    'companyProfile' => new CompanyProfileResource($companyProfile),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'error',
                'message'    => $e->getMessage(),
                'statusCode' => 500,

            ], 500);
        }
    }

    public function getReviews(Request $request)
    {
        $user = Auth::user();

        try {
            $company_profile = CompanyProfile::where('user_id', $user->id)->firstOrFail();

            $request->merge([
                'company_id' => $company_profile->id,
            ]);

            $reviews = $this->reviewService->getAllReviews($request);

            return response()->json([
                'message'    => 'review fetching successful',
                'statusCode' => 200,
                'status'     => 'success',
                'data'       => [
                    'reviews' => ReviewResource::collection($reviews),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'statusCode' => 500,
                'status'     => 'error',

            ], 500);
        }
    }

    public function updateMyCompanyProfile(CompanyProfileRequest $request)
    {
        try {
            $user = Auth::user();

            $this->companyProfileService->updateMyCompanyProfile($user->id, $request->toArray());
            $companyProfile = $this->companyProfileService->getMyCompanyProfile($user->id);

            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'Company Profile updated successfully',
                'data'       => [
                    'companyProfile' => new CompanyProfileResource($companyProfile),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'error',
                'message'    => $e->getMessage(),
                'statusCode' => 500,

            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $companyProfile = $this->companyProfileService->deleteCompanyProfile($id);
            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'Company Profile deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'error',
                'message'    => $e->getMessage(),
                'statusCode' => 500,

            ], 500);
        }
    }
}
