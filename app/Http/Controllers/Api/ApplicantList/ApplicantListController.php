<?php

namespace App\Http\Controllers\Api\ApplicantList;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantProfileResource;
use App\Models\ApplicantProfile\ApplicantProfile;
use App\Services\ApplicantList\ApplicantListService;
use Illuminate\Http\Request;

class ApplicantListController extends Controller
{

    protected $applicantListService;

    public function __construct(ApplicantListService $applicantListService){
        $this->applicantListService=$applicantListService;
    }
    public function index(){
        try {
          $applicantList=  $this->applicantListService->getApplicantList();
          return response()->json([
            'message'    => 'applicant list fetching successful',
            'statusCode' => 200,
            'status'     => 'success',
            'data'       => [
                'reviews' => ApplicantProfileResource::collection($applicantList),
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

    public function show($id){
        try {
          $applicantList=  $this->applicantListService->getApplicantById($id);
          return response()->json([
            'message'    => 'applicant  fetching successful',
            'statusCode' => 200,
            'status'     => 'success',
            'data'       => [
                'applicant' => ApplicantProfileResource::make($applicantList),
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
