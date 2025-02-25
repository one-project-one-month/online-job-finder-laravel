<?php

namespace App\Http\Controllers\Api\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Job\JobRequest;
use App\Http\Resources\Job\JobResource;
use App\Models\Job\Job;
use App\Models\Job\JobPost;
use App\Services\Job\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $jobService;
    public function __construct(JobService $jobService){
        $this->jobService=$jobService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     try {
        $jobList=$this->jobService->getAllJobs();
        return response()->json([
            'message'=>'job fetch successfully',
            'status'=>'success',
            'statusCode'=>200,
            'data'=>[
                'jobs'=> JobResource::collection($jobList)
            ]
        ],200);
     } catch (\Exception $e) {
       return response()->json([
        'message'=>$e->getMessage(),
        'status'=>'error',
        'statusCode'=>500,
       ],500);
     }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        try {
            $job=$this->jobService->createJob($request->toArray());
            $createJob=JobPost::where('id',$job->id)->first();

            return response()->json([
                'message'=>'job created successfully',
                'status'=>'success',
                'statusCode'=>201,
                'data'=>[
                    'job'=> JobResource::make($createJob)
                ]
            ],201);
         } catch (\Exception $e) {
           return response()->json([
            'message'=>$e->getMessage(),
            'status'=>'error',
            'statusCode'=>500,
           ],500);
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $job=$this->jobService->showJobById($id);
            return response()->json([
                'message'=>'job showed successfully',
                'status'=>'success',
                'statusCode'=>200,
                'data'=>[
                    'job'=> JobResource::make($job)
                ]
            ],200);
         } catch (\Exception $e) {
           return response()->json([
            'message'=>$e->getMessage(),
            'status'=>'error',
            'statusCode'=>500,
           ],500);
         }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $job=$this->jobService->updateJob($request->toArray(),$id);
            return response()->json([
                'message'=>'job updated successfully',
                'status'=>'success',
                'statusCode'=>201,
                'data'=>[
                    'job'=> JobResource::make($job)
                ]
            ],201);
         } catch (\Exception $e) {
           return response()->json([
            'message'=>$e->getMessage(),
            'status'=>'error',
            'statusCode'=>500,
           ],500);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $job=$this->jobService->deleteJob($id);
            return response()->json([
                'message'=>'job deleted successfully',
                'status'=>'success',
                'statusCode'=>200,
            ],200);
         } catch (\Exception $e) {
           return response()->json([
            'message'=>$e->getMessage(),
            'status'=>'error',
            'statusCode'=>500,
           ],500);
         }
    }
}
