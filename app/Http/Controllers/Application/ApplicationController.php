<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\ApplicationRequest;
use App\Http\Resources\Application\ApplicationResource;
use App\Services\Application\ApplicationService;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    protected $applicationService;

    public function __construct(ApplicationService $applicationService){
        $this->applicationService=$applicationService;
    }

    public function index(){
       try {
       $applicationList=$this->applicationService->getAllApplications();
       return response()->json([
        'message'=>'applications fetched successfully',
        'status'=>'success',
        'statusCode'=>200,
        'data'=>[
            'application'=>ApplicationResource::make($applicationList)
         ]
    ],200);
       } catch (\Exception $e) {
        return response()->json([
            'message'=>$e->getMessage(),
            'status'=>'error',
            'statusCode'=>500,
        ],500);
       }
    }

    public function store(ApplicationRequest $request){

        try {
            $application=$this->applicationService->createApplication($request->toArray());

            return response()->json([
             'message'=>'applications created successfully',
             'status'=>'success',
             'statusCode'=>201,
             'data'=>[
                'application'=>ApplicationResource::make($application)
             ]
         ],201);
            } catch (\Exception $e) {
             return response()->json([
                 'message'=>$e->getMessage(),
                 'status'=>'error',
                 'statusCode'=>500,
             ],500);
            }
    }

    public function show($id){
        try {
            $application=$this->applicationService->getApplicationById($id);
            return response()->json([
             'message'=>'applications fetched successfully',
             'status'=>'success',
             'statusCode'=>200,
             'data'=>[
                'application'=>ApplicationResource::make($application)
             ]
         ],200);
            } catch (\Exception $e) {
             return response()->json([
                 'message'=>$e->getMessage(),
                 'status'=>'error',
                 'statusCode'=>500,
             ],500);
            }
    }

    public function update(ApplicationRequest $request,$id){
        try {
            $applicationUpdated=$this->applicationService->update($request->validated(),$id);

            return response()->json([
             'message'=>'applications updated successfully',
             'status'=>'success',
             'statusCode'=>200,
             'data'=>[
                'application'=>ApplicationResource::make($applicationUpdated)
             ]
         ],200);
            } catch (\Exception $e) {
             return response()->json([
                 'message'=>$e->getMessage(),
                 'status'=>'error',
                 'statusCode'=>500,
             ],500);
            }
    }

    public function destroy($id){
        try {
            $application=$this->applicationService->delete($id);

            return response()->json([
             'message'=>'applications delete successfully',
             'status'=>'success',
             'statusCode'=>200,
             'data'=>[
                'application'=>ApplicationResource::make($application)
             ]
         ],200);
            } catch (\Exception $e) {
             return response()->json([
                 'message'=>$e->getMessage(),
                 'status'=>'error',
                 'statusCode'=>500,
             ],500);
            }
    }
}
