<?php
namespace App\Http\Controllers\ApplicantExperience;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicantExperienceRequest;
use App\Http\Resources\ApplicantExperienceResource;
use App\Services\ApplicantExperience\ApplicantExperienceService;
use Illuminate\Support\Facades\Gate;

class ApplicantExperienceController extends Controller
{
    protected $applicantExperienceService;

    public function __construct(ApplicantExperienceService $applicantExperienceService)
    {
        $this->applicantExperienceService = $applicantExperienceService;
    }

    public function index()
    {
        try {
            $applicantExperience = $this->applicantExperienceService->getAll();
            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'Data retrieved Successfully',
                'data'       => [
                    'experiences' => ApplicantExperienceResource::collection($applicantExperience),
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

    public function show($id)
    {
        try {
            $applicantExperience = $this->applicantExperienceService->show($id);
            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'Data retrieved Successfully',
                'data'       => [
                    'experience' => new ApplicantExperienceResource($applicantExperience),
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

    public function store(ApplicantExperienceRequest $request)
    {
        try {
            $applicantExperience = $this->applicantExperienceService->create($request->toArray());
            return response()->json([
                'status'     => 'success',
                'statusCode' => 201,
                'message'    => 'Data stored Successfully',
                'data'       => [
                    'experience' => new ApplicantExperienceResource($applicantExperience),
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'error',
                'statusCode' => 500,
                'message'    => $e->getMessage(),
            ], 500);
        }
    }

    public function update(ApplicantExperienceRequest $request, $id)
    {
        try {
            if (Gate::denies('update', $id)) {
                return response()->json([
                    'message'    => 'Unauthorized action',
                    'status'     => 'error',
                    'statusCode' => 403,
                ], 403);
            }
            $applicantExperience = $this->applicantExperienceService->update($request->toArray(), $id);
            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'Data updated Successfully',
                'data'       => [
                    'experience' => new ApplicantExperienceResource($applicantExperience),
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

    public function destroy($id)
    {
        try {
            if (Gate::denies('delete', $id)) {
                return response()->json([
                    'message'    => 'Unauthorized action',
                    'status'     => 'error',
                    'statusCode' => 403,
                ], 403);
            }
            $applicantExperience = $this->applicantExperienceService->destroy($id);
            return response()->json([

            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'error',
                'statusCode' => 500,
                'message'    => $e->getMessage(),
            ], 500);
        }
    }
}
