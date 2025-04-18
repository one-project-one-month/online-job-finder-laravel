<?php
namespace App\Http\Controllers\Api\Skills;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Http\Resources\SkillResource;
use App\Models\Skills\Skill;
use App\Services\Skills\SkillService;

class SkillController extends Controller
{
    private $skillService;

    public function __construct(SkillService $skillService)
    {
        $this->skillService = $skillService;
    }

    public function index()
    {
        try {
            $skills = $this->skillService->getAllSkills();
            return response()->json([
                'status'     => 'success',
                'message'    => 'fetching successful',
                'statusCode' => 200,
                'data'       => [
                    'skills' => SkillResource::collection($skills),
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

    public function show(Skill $skill)
    {
        try {
            $skill = $this->skillService->findSkill($skill->id);
            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'Skill fetched successful',
                'data'       => [
                    'skill' => new SkillResource($skill),
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

    public function store(SkillRequest $request)
    {
        try {
            $skill = $this->skillService->createSkill($request->toArray());
            return response()->json([
                'status'     => 'success',
                'statusCode' => 201,
                'message'    => 'Skill created successful',
                'data'       => [
                    'skill' => new SkillResource($skill),
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

    public function update(UpdateSkillRequest $request, $id)
    {
        try {
            $skill = $this->skillService->updateSkill($request->toArray(), $id);
            return response()->json([
                'status'     => 'success',
                'statusCode' => 200,
                'message'    => 'Skill updated successful',
                'data'       => [
                    'skill' => new SkillResource($skill),
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

    public function destroy(Skill $skill)
    {
        try {
            $this->skillService->destroySkill($skill->id);
            return response()->json([], 204);
        } catch (\Exception $e) {
            return response()->json([
                'status'     => 'error',
                'statusCode' => 200,
                'message'    => $e->getMessage(),
            ], 500);
        }
    }

}
