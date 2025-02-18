<?php

namespace App\Http\Controllers\Api\Resumes;
use Exception;
use Illuminate\Http\Request;
use App\Models\Resumes\Resume;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResumeRequest;
use App\Http\Resources\ResumeResource;
use App\Services\Resumes\ResumeService;

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
            $user=auth()->user();
            $resume = $this->resumeService->createResume($user->id,$request->file('file_path'));
            return response()->json(
                [
                    'status' => 'success',
                    'statusCode'=>200,
                    'message' => 'Resumes created successfully',
                    'data'=>[
                        'resume' => new ResumeResource($resume)
                    ]
                ]
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'statusCode'=>500,
                'status'=>'error'
            ],500);
        }
    }


    public function show(Resume $resume)
    {
       try {
        $resume=$this->resumeService->getResumeById($resume->id);
        return response()->json([
            'status'=>'success',
            'statusCode'=>200,
            'message'=>'fetching resume success',
            'data'=>[
                'resume'=> new ResumeResource($resume)
            ]
            ]);
       } catch (\Exception $e) {
        return response()->json([
            'message' => $e->getMessage(),
            'statusCode'=>500,
            'status'=>'error'
        ],500);
       }
    }


    public function update(Request $request ,Resume $resume)
    {
       try {
        $user=auth()->user();
        $this->resumeService->updateResume($user->id,$request->file('file_path'),$resume->id);
        return response()->json([
            'message'=>'resume update successful',
            'status'=>'success',
            'statusCode'=>'200',
           'data'=>[
            'resume'=>new ResumeResource($this->resumeService->getResumeById($resume->id))
           ]
            ]);
       } catch (\Exception $e) {
       return response()->json([
        'message'=>$e->getMessage()
       ]);
       }
    }


    public function destroy(Resume $resume)
    {
        $resume=$this->resumeService->deleteResume($resume);
    }
}
