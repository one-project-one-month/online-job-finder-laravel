<?php

// app/Http/Controllers/JobCategoryController.php

namespace App\Http\Controllers\Api\JobCategory; // Add this if it's inside the Api folder


use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobCategoryRequest;
use App\Http\Resources\JobCategoryResource;
use App\Services\JobCategories\JobCategoryService;


class JobCategoryController extends Controller
{
    protected $jobCategoryService;

    public function __construct(JobCategoryService $jobCategoryService)
    {
        $this->jobCategoryService = $jobCategoryService;
    }

    public function create(JobCategoryRequest $request)
    {
        $data = $request->validated(); // Validate the request data
        $jobCategory = $this->jobCategoryService->createJobCategory($data); // Call service to create JobCategory
        return new JobCategoryResource($jobCategory); // Return the created JobCategory resource
    }

    public function getall()
    {
        $jobCategories = $this->jobCategoryService->getAllJobCategories(); // Call service to get all JobCategories
        return JobCategoryResource::collection($jobCategories); // Return the JobCategories resource
    }

    public function get($id)
    {
        $jobCategory = $this->jobCategoryService->getJobCategory($id); // Call service to get JobCategory by id
        return new JobCategoryResource($jobCategory); // Return the JobCategory resource
    }

    public function update(JobCategoryRequest $request, $id)
    {
        $data = $request->validated(); // Validate the request data
        $jobCategory = $this->jobCategoryService->updateJobCategory($data, $id); // Call service to update JobCategory
        return new JobCategoryResource($jobCategory); // Return the updated JobCategory resource
    }

    public function delete($id)
    {
        $jobCategory = $this->jobCategoryService->getJobCategory($id); // Call service to get JobCategory by id
        $jobCategory->delete(); // Delete the JobCategory record
        return response()->json(null, Response::HTTP_NO_CONTENT); // Return no content
    }

}
