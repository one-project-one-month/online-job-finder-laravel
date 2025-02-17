<?php

namespace App\Http\Controllers\Api\Resumes;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;





use App\Http\Requests\ResumeRequest;
use App\Http\Resources\ResumeResource;
use App\Services\Resumes\ResumeService;
use App\Http\Controllers\Api\Resumes\ResumeController;

class ResumeController extends Controller
{
    private $resumeService;

    public function __construct(ResumeService $resumeService){

              $this->resumeService = $resumeService;
        }


    public function index()
    {
        try {
            $resumes = $this->resumeService->getAllResumes();




            return response()->json([
                'message'=>'fetching successful',
                'status'=>'success',
               'data'=>[
                'resumes' => ResumeResource::collection($resumes)
               ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message'=>$e->getMessage(),
                'status'=>'error'
            ],500);
        }
    }


    public function store(ResumeRequest $request)
    {
        try {



            $resume = $this->resumeService->createResume($request->toArray());





            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Location created successfully',
                    'data'=>[
                        'resume' => new ResumeResource($resume)
                    ]
                ]
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status'=>'error'
            ],500);
        }
    }


    public function show(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
