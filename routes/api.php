<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JWTMiddleware;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Skills\SkillController;

use App\Http\Controllers\Api\Resumes\ResumeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/auth')->group(function(){
    Route::post('signup',[AuthController::class,'register']);
    Route::post('signin',[AuthController::class,'login']);
});

Route::middleware(JWTMiddleware::class)->group(function(){
    Route::get('users',[AuthController::class,'getUser']);
    Route::post('signout',[AuthController::class,'logout']);
    Route::post('password/change',[AuthController::class,'changePassword']);
});

Route::prefix('admin/me')->middleware(JWTMiddleware::class)->group(function (){
    Route::resource('jobCategories',JobCategoryController::class)->middleware(CheckAdminMiddleware::class);
    Route::resource('skills',SkillController::class);
    Route::apiResource('locations', LocationController::class)->middleware(CheckAdminMiddleware::class);
});



Route::prefix('/me')->middleware([JWTMiddleware::class,MustBeApplicant::class])->group(function(){
    Route::apiResource('profile',ApplicantProfileController::class);
});

Route::apiResource('resumes', ResumeController::class)->middleware(JWTMiddleware::class);
