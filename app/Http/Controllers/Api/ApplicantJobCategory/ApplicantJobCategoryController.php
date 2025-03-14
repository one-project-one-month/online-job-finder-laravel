<?php
namespace App\Http\Controllers\Api\ApplicantJobCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicantJobCategoryRequest;
use App\Http\Requests\UpdateApplicantJobCategoryRequest;
use App\Http\Resources\ApplicantJobCategoryResource;
use App\Services\ApplicantJobCategory\ApplicantJobCategoryService;

class ApplicantJobCategoryController extends Controller
{
    protected $applicantJobCategoryService;
    public function __construct(ApplicantJobCategoryService $applicantJobCategoryService)
    {
        $this->applicantJobCategoryService = $applicantJobCategoryService;
    }

    public function index()
    {
        try {
            $applicantJobCategory = $this->applicantJobCategoryService->getAll();
            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'Applicant-job-categories retrives successfully',
                'data'       => [
                    'jobCategories' => ApplicantJobCategoryResource::collection($applicantJobCategory),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'false',
                'statusCode' => 500,
                'message'    => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $applicantJobCategoryId = $this->applicantJobCategoryService->show($id);
            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => "fetching success",
                'data'       => [
                    'jobCategory' => new ApplicantJobCategoryResource($applicantJobCategoryId),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'false',
                'statusCode' => 500,
                'message'    => $e->getMessage(),
            ], 500);
        }
    }
    public function store(ApplicantJobCategoryRequest $request)
    {
        try {
            $applicantJobCategories = $this->applicantJobCategoryService->create($request);

            return response()->json([
                'status'     => 'success',
                'statusCode' => 201,
                'message'    => 'Applicant-job-category created successfully',
                'data'       => [
                    'jobCategories' => ApplicantJobCategoryResource::collection($applicantJobCategories),
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'false',
                'statusCode' => 500,
                'message'    => $e->getMessage(),
            ], 500);
        }
    }

   

    public function update(UpdateApplicantJobCategoryRequest $request, $id)
    {

        try {
            $applicantJobCategory = $this->applicantJobCategoryService->update($request, $id);

            return response()->json(
                [
                    'status'     => 'success',
                    'statusCode' => 200,
                    'message'    => 'Applicant-skill updated successfully',
                    'data'       => [
                        'jobCategory' => ApplicantJobCategoryResource::collection($applicantJobCategory),
                    ],
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message'    => $e->getMessage(),
                    'status'     => 'fail to update',
                    'statusCode' => 500,
                ],
                500
            );
        }
    }

    public function destroy($id)
    {
        try {
            $this->applicantJobCategoryService->delete($id);
            return response()->json([
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'fail to delete',
                'statusCode' => 500,
                'message'    => $e->getMessage(),
            ], 500);
        }
    }
}
