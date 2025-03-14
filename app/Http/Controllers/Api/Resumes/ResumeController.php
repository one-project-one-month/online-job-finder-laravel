<?php
namespace App\Http\Controllers\Api\Resumes;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResumeRequest;
use App\Http\Resources\ResumeResource;
use App\Models\Resumes\Resume;
use App\Services\Resumes\ResumeService;
use App\Services\Storage\StorageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResumeController extends Controller
{
    private $resumeService;
    private $storageService;

    public function __construct(ResumeService $resumeService, StorageService $storageService)
    {
        $this->resumeService  = $resumeService;
        $this->storageService = $storageService;
    }

    public function index()
    {
        try {
            $resumes = $this->resumeService->getAllResumes();

            return response()->json([
                'message'    => 'fetching successful',
                'status'     => 'success',
                'statusCode' => 200,
                'data'       => [
                    'resumes' => ResumeResource::collection($resumes),
                ],
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'statusCode' => 500,
                'status'     => 'error',
            ], 500);
        }
    }

    public function show(Resume $resume)
    {
        try {
            $resume = $this->resumeService->getResumeById($resume->id);
            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'fetching resume success',
                'data'       => [
                    'resume' => new ResumeResource($resume),
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

    public function getDefaultResume() 
    {
        $resume = $this->resumeService->getDefaultResume();
        return response()->json([
            'status'     => 'success',
            'statusCode' => 200,
            'message'    => 'fetching resume success',
            'data'       => [
                'resume' => new ResumeResource($resume),
            ],
        ], 200);
    }

    public function store(ResumeRequest $request)
    {

        try {
            $user = Auth::user();

            $file_path = $this->storageService->store('resumes', $request->file('file_path'));
            $name      = $request->file('file_path')->getClientOriginalName();

            DB::beginTransaction();
            $resume = $this->resumeService->createResume([
                'user_id'   => $user->id,
                'name'      => $name,
                'file_path' => $file_path,
                'is_default' => $request->is_default,
            ]);
            DB::commit();

            return response()->json(
                [
                    'status'     => 'success',
                    'statusCode' => 201,
                    'message'    => 'Resumes uploaded successfully',
                    'data'       => [
                        'resume' => new ResumeResource($resume),
                    ],
                ], 201
            );
        } catch (\Exception $e) {
            return response()->json([
                'message'    => $e->getMessage(),
                'statusCode' => 500,
                'status'     => 'error',
            ], 500);
        }
    }

    public function update(Request $request, Resume $resume)
    {
        try {
            $user = Auth::user();
            $this->resumeService->updateResume($user->id, $request->file('file_path'), $resume->id);
            return response()->json([
                'message'    => 'resume update successful',
                'status'     => 'success',
                'statusCode' => '200',
                'data'       => [
                    'resume' => new ResumeResource($this->resumeService->getResumeById($resume->id)),
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

    public function destroy(Resume $resume)
    {
        $resume = $this->resumeService->deleteResume($resume);
        return response()->json([
        ], 204);
    }
}
