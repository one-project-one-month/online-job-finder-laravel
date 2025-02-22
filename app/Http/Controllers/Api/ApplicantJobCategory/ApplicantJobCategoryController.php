<?php

namespace App\Http\Controllers\Api\ApplicantJobCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicantJobCategoryRequest;
use App\Http\Resources\ApplicantJobCategoryResource;
use App\Services\ApplicantJobCategory\ApplicantJobCategoryService;

class ApplicantJobCategoryController extends Controller
{
    protected $applicantJobCategoryService;
    public function __construct(ApplicantJobCategoryService $applicantJobCategoryService)
    {
        $this -> applicantJobCategoryService = $applicantJobCategoryService;
    }
    public function store(ApplicantJobCategoryRequest $request)
    {
        try {
            $applicantJobCategory = $this -> applicantJobCategoryService -> create($request);
            return response()->json([
                'status' => 'success',
                'statusCode' => 201,
                'message' => 'Applicant-job-category created successfully',
                'data' => [
                    'applicantJobCategory' => new ApplicantJobCategoryResource($applicantJobCategory)
                ]
            ], 201);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'statusCode' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

