<?php

// app/Http/Controllers/JobCategoryController.php

namespace App\Http\Controllers\Api\JobCategory; // Add this if it's inside the Api folder

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Requests\JobCategoryRequest;
use App\Http\Requests\UpdateJobCategory;
use App\Http\Requests\UpdateJobCategoryRequest;
use App\Http\Resources\JobCategoryResource;
use App\Models\JobCategory\JobCategory;
use App\Services\JobCategories\JobCategoryService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class JobCategoryController extends Controller implements HasMiddleware
{
    private $jobCategoryService;

    public function __construct(JobCategoryService $jobCategoryService)
    {
        $this->jobCategoryService = $jobCategoryService;
    }

    public static function middleware(): array
    {
        return [
            new Middleware(middleware: CheckAdminMiddleware::class, except: ['index', 'show']),
        ];
    }

    public function store(JobCategoryRequest $request)
    {
        try {
            $jobCategory = $this->jobCategoryService->createJobCategory($request->toArray());

            return response()->json(
                [
                    'status'     => 'success',
                    'message'    => 'Job Category created successful',
                    'statusCode' => 500,
                    'data'       => [
                        'jobCategory' => new JobCategoryResource($jobCategory),
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

    public function index()
    {
        try {
            $jobCategories = $this->jobCategoryService->getAllJobCategories();

            return response()->json([
                'status'     => 'success',
                'message'    => 'fetching successful',
                'statusCode' => 200,
                'data'       => [
                    'jobCategories' => JobCategoryResource::collection($jobCategories),
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
            $jobCategory = $this->jobCategoryService->getJobCategory($id); // Call service to get JobCategory by id
            return response()->json([
                'status'     => 'success',
                'message'    => 'Fetching successful',
                'statusCode' => 200,
                'data'       => [
                    'jobCategory' => new JobCategoryResource($jobCategory),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'error',
                'statusCode' => 500,
                'message'    => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateJobCategoryRequest $request, $id)
    {
        try {
            $jobCategory = $this->jobCategoryService->updateJobCategory($request->toArray(), $id); // Call service to update JobCategory
            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'update successful',
                'data'       => [
                    'jobCategory' => new JobCategoryResource($jobCategory),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'error',
                'statusCode' => 500,
                'message'    => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(jobCategory $jobCategory)
    {
        try {
            $jobCategory = $this->jobCategoryService->deleteJobCategory($jobCategory->id);
            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'deleted successful',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'error',
                'statusCode' => 500,
                'message'    => $e->getMessage(),
            ], 500);
        }
    }

}
