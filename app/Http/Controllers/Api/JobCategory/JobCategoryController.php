<?php

// app/Http/Controllers/JobCategoryController.php

namespace App\Http\Controllers\Api\JobCategory; // Add this if it's inside the Api folder


use App\Models\JobCategory\JobCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobCategoryRequest;
use App\Http\Resources\JobCategoryResource;
use App\Services\JobCategories\JobCategoryService;
use Request;


class JobCategoryController extends Controller
{
    private $jobCategoryService;

    public function __construct(JobCategoryService $jobCategoryService)
    {
        $this->jobCategoryService = $jobCategoryService;
    }

    public function store(JobCategoryRequest $request)
    {
      try {
        $jobCategory = $this->jobCategoryService->createJobCategory($request->toArray());

        return response()->json(
            [
                'status'=>'success',
                'message'=>'Job Category created successful',
                'data'=>[
                    'jobCategory'=> new JobCategoryResource($jobCategory)
                ]
            ],201
            );
      } catch (\Exception $e) {
        return response()->json(
            [
               'message'=>$e->getMessage(),

            ],500
            );
      }
    }

    public function index()
    {
       try {
        $jobCategories = $this->jobCategoryService->getAllJobCategories();

        return response()->json([
           'status'=>'success',
           'message'=>'fetching successful',
           'data'=>[
            'jobCategories'=> JobCategoryResource::collection($jobCategories)
           ]
        ],200);
       } catch (\Exception $e) {
        return response()->json([
            'status'=>'false',
            'message'=>$e->getMessage(),

         ],500);
       }
    }

    public function show($id)
    {
       try {
        $jobCategory = $this->jobCategoryService->getJobCategory($id); // Call service to get JobCategory by id
        return response()->json([
            'status' => 'success',
            'message' => 'Fetching successful',
            'data'=>[
                'jobCategory' => new JobCategoryResource($jobCategory),
            ]
        ], 200);
       } catch (\Exception $e) {
       return response()->json([
        'status'=>'error',
        'message'=>$e->getMessage(),
       ],500);
       }
    }

    public function update(JobCategoryRequest $request,JobCategory $jobCategory)
    {
      try {
        $jobCategory = $this->jobCategoryService->updateJobCategory($request->toArray(), $jobCategory->id); // Call service to update JobCategory
       return response()->json([
        'status'=>'success',
        'message'=>'update successful',
        'data'=>[
            'jobCategory'=> new JobCategoryResource($jobCategory)
        ]
       ],200);
      } catch (\Exception $e) {
        return response()->json([
            'status'=>'error',
            'message'=>$e->getMessage()
        ],500);
      }
    }

    public function destroy(jobCategory $jobCategory)
    {
        try {
            $jobCategory = $this->jobCategoryService->deleteJobCategory($jobCategory->id);
            return response()->json([
                'status'=>'success',
                'message'=>'deleted successful',
               ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>'error',
                'message'=>$e->getMessage()
            ],500);
        }
    }

}
