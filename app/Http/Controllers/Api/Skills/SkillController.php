<?php

namespace App\Http\Controllers\Api\Skills;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Http\Resources\SkillResource;
use App\Models\Skills\Skill;
use App\Services\Skills\SkillService;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    private $skillService;

    public function __construct(SkillService $skillService)
    {
        $this->skillService = $skillService;
    }

    public function index()
    {
        try{
            $skills = $this->skillService->getAllSkills();
            return response()->json([
                'status'=>'success',
                'message'=>'fetching successful',
                'skills'=> SkillResource::collection($skills)
            ],200);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'status'=>'error',
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function store(SkillRequest $request)
    {
        try{
            $skill = $this->skillService->createSkill($request->toArray());
            return response()->json([
                'status'=>'success',
                'message'=>'Skill created successful',
                'skill'=> new SkillResource($skill)
            ],201);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'status'=>'error',
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function destroy(Skill $skill)
    {
        try{
            $this->skillService->destroySkill($skill->id);
            return response()->json([
                'status'=>'success',
                'message'=>'Skill deleted successful'
            ],200);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function show(Skill $skill)
    {
        try{
            $skill = $this->skillService->findSkill($skill->id);
            return response()->json([
                'status'=>'success',
                'message'=>'Skill fetched successful',
                'skill'=> new SkillResource($skill)
            ],200);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }


    public function update(SkillRequest $request,Skill $skill)
    {
        try{
            $skill = $this->skillService->updateSkill($request->toArray(),$skill->id);
            return response()->json([
                'status'=>'success',
                'message'=>'Skill updated successful',
                'skill'=> new SkillResource($skill)
            ],200);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }









}
