<?php
namespace App\Http\Controllers\Api\JobList;

use App\Http\Controllers\Controller;
use App\Http\Requests\SavedJob\SavedJobRequest;
use App\Http\Resources\Job\JobResource;
use App\Http\Resources\SavedJob\SavedJobResource;
use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\SavedJob\SavedJob;
use App\Services\JobList\JobListService;

class JobListController extends Controller
{
    protected $jobListService;

    public function __construct(JobListService $jobListService)
    {
        $this->jobListService = $jobListService;
    }

    public function toggleSaveJob(SavedJobRequest $request, $id)
    {
        $user      = auth()->user();
        $applicant = ApplicantProfile::where('user_id', $user->id)->first();
        $saveJob   = SavedJob::where('job_post_id', $id)->first();
        if ($saveJob) {
            $saveJob->delete();
            return response()->json([
                'message'    => 'job unsaved successfully',
                'status'     => 'success',
                'statusCode' => 200,

            ], 200);
        } else {
            $createSavedJob = SavedJob::create([
                'job_post_id'  => $id,
                'applicant_id' => $applicant->id,
            ]);
            return response()->json([
                'message'    => 'job saved',
                'status'     => 'success',
                'statusCode' => 201,
                'data'       => [
                    'job' => SavedJobResource::make($createSavedJob),
                ],
            ], 201);
        }
    }

    public function index()
    {
        try {
            $jobList = $this->jobListService->getAllJobs();
            return response()->json([
                'message'    => 'job fetch successfully',
                'status'     => 'success',
                'statusCode' => 200,
                'data'       => [
                    'jobs' => JobResource::collection($jobList),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'status'     => 'error',
                'statusCode' => 500,
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $job = $this->jobListService->getJobById($id);
            return response()->json([
                'message'    => 'job fetch successfully',
                'status'     => 'success',
                'statusCode' => 200,
                'data'       => [
                    'job' => JobResource::make($job),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'status'     => 'error',
                'statusCode' => 500,
            ], 500);
        }
    }
}
