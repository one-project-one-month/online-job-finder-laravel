<?php

namespace App\Http\Controllers\Api\SavedJob;

use App\Http\Controllers\Controller;
use App\Http\Requests\SavedJob\SavedJobRequest;
use App\Http\Resources\Job\JobResource;
use App\Http\Resources\SavedJob\SavedJobResource;
use App\Models\ApplicantProfile\ApplicantProfile;
use App\Models\SavedJob\SavedJob;
use App\Services\SavedJob\SavedJobService;
use Illuminate\Http\Request;

class SavedJobController extends Controller
{
    protected $savedJobService;

    public function __construct(SavedJobService $savedJobService){
        $this->savedJobService=$savedJobService;
    }

    public function index(){

        try {
            $savedJobsList=$this->savedJobService->savedJobsList();
            return response()->json([
              'message'    => 'applicant  fetching successful',
              'statusCode' => 200,
              'status'     => 'success',
              'data'       => [
                  'savedJobs' => SavedJobResource::collection($savedJobsList),
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

}
