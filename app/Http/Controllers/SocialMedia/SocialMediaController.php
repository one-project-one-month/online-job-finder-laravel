<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMediaRequest;
use App\Http\Resources\SocialMediaResource;
use App\Models\SocialMedia\SocialMedia;
use App\Services\SocialMedia\SocialMediaService;

class SocialMediaController extends Controller
{
    protected $socialMedia;

    public function __construct(SocialMediaService $socialMedia){
        $this->socialMedia=$socialMedia;
    }
    public function index(){
       $socialMedia= $this->socialMedia->getAllSocialMedia();
       return response()->json([
        'message'=>'social media created successfully',
        'status'=>'success',
        'statusCode'=>200,
        'data'=>[
            'socialMedias'=>SocialMediaResource::collection($socialMedia)
        ]
        ],200);
    }

    public function store(SocialMediaRequest $request){
        $socialMedia=$this->socialMedia->createSocialMedia($request->validated());

        return response()->json([
            'message'=>'social media created successfully',
            'status'=>'success',
            'statusCode'=>201,
            'data'=>[
                'socialMedias'=>SocialMediaResource::make($socialMedia)
            ]
            ],201);
    }

    public function show($id){
        $socialMedia=$this->socialMedia->getSocialMediaById($id);

        return response()->json([
            'message'=>'social media created successfully',
            'status'=>'success',
            'statusCode'=>200,
            'data'=>[
                'socialMedias'=>SocialMediaResource::make($socialMedia)
            ]
            ],200);
    }

    public function update(SocialMediaRequest $request , $id){
        $updateSocialMedia=$this->socialMedia->updateSocialMedia($request->toArray(),$id);

        return response()->json([
            'message'=>'Social Media Update successfully',
            'status'=>'success',
            'statusCode'=>200,
            'data'=>[
                'socialMedia'=>SocialMediaResource::make($updateSocialMedia)
            ]
            ],200);
    }

    public function destroy($id){
     $this->socialMedia->deleteSocialMedia($id);
     return response()->json([
        'message'=>'social media deleted successfully',
        'status'=>'success',
        'statusCode'=>200
     ],200);
    }
}
