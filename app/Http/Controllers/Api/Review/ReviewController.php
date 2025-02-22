<?php

namespace App\Http\Controllers\Api\Review;

use App\Http\Requests\Review\UpdateReviewRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Review\ReviewService;
use App\Http\Requests\Review\ReviewRequest;
use App\Http\Resources\Review\ReviewResource;
use App\Repositories\Review\ReviewRepository;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService){
        $this->reviewService=$reviewService;
    }

    public function index(){
     try {
        $ReviewList=$this->reviewService->getAllReview();
        return response()->json([
            'message'=>'review fetching successful',
            'statusCode'=>200,
            'status'=>'success',
            'data'=>[
                'review'=>ReviewResource::collection($ReviewList)
            ]
            ],200);
     } catch (\Exception $e) {
        return response()->json([
            'message'=>$e->getMessage(),
            'statusCode'=>500,
            'status'=>'error',

        ],500);
     }
    }

    public function store(ReviewRequest $request){
        try {
           $createReview=$this->reviewService->createReview($request->toArray());
           return response()->json([
               'message'=>'review created successfully',
               'statusCode'=>201,
               'status'=>'success',
               'data'=>[
                   'review'=>new ReviewResource($createReview)
               ]
               ],201);
        } catch (\Exception $e) {
           return response()->json([
               'message'=>$e->getMessage(),
               'statusCode'=>500,
               'status'=>'error',
           ],500);
        }
       }

       public function show($id){
        try {
           $review=$this->reviewService->showReviewById($id);
           return response()->json([
               'message'=>'review fetched successfully',
               'statusCode'=>200,
               'status'=>'success',
               'data'=>[
                   'review'=>new ReviewResource($review)
               ]
               ],200);
        } catch (\Exception $e) {
           return response()->json([
               'message'=>$e->getMessage(),
               'statusCode'=>500,
               'status'=>'error',
           ],500);
        }
       }

       public function update(UpdateReviewRequest $request , $id){
        try {
           $updateReview=$this->reviewService->updateReview($request->toArray(),$id);
           return response()->json([
               'message'=>'review updated successfully',
               'statusCode'=>200,
               'status'=>'success',
               'data'=>[
                   'review'=>new ReviewResource($updateReview)
               ]
               ],200);
        } catch (\Exception $e) {
           return response()->json([
               'message'=>$e->getMessage(),
               'statusCode'=>500,
               'status'=>'error',
           ],500);
        }
       }

       public function destroy($id){
        try {
           $review=$this->reviewService->destroyReviewById($id);
           return response()->json([
               'message'=>'review deleted successfully',
               'statusCode'=>200,
               'status'=>'success',
               ],200);
        } catch (\Exception $e) {
           return response()->json([
               'message'=>$e->getMessage(),
               'statusCode'=>500,
               'status'=>'error',
           ],500);
        }
       }


}
