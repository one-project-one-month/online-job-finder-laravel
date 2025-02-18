<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JWTMiddleware;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Skills\SkillController;
use App\Http\Controllers\Api\Locations\LocationController;
use App\Http\Controllers\Api\JobCategory\JobCategoryController;
use App\Http\Controllers\Api\CompanyProfile\CompanyProfileController;
use App\Http\Middleware\CheckRecruiterMiddleware;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/auth')->group(function(){
    Route::post('signup',[AuthController::class,'register']);
    Route::post('signin',[AuthController::class,'login']);
});

Route::middleware([JWTMiddleware::class])->group(function () {
    Route::get('users', [AuthController::class, 'getUser']);
    Route::post('signout', [AuthController::class, 'logout']);
    Route::post('password/change', [AuthController::class, 'changePassword']);

    // Routes that only require JWT token (Public for authenticated users)
    Route::get('company-profiles', [CompanyProfileController::class, 'index']);
    Route::get('company-profiles/{id}', [CompanyProfileController::class, 'show']);

    // Routes that require both JWT token & Recruiter role
    Route::middleware([CheckRecruiterMiddleware::class])->group(function () {
        Route::post('company-profiles', [CompanyProfileController::class, 'store']);
        Route::put('company-profiles/{id}', [CompanyProfileController::class, 'update']);
        Route::delete('company-profiles/{id}', [CompanyProfileController::class, 'destroy']);
    });
});

Route::prefix('admin/me')->middleware(JWTMiddleware::class)->group(function (){
    Route::resource('jobCategories',JobCategoryController::class)->middleware(CheckAdminMiddleware::class);
    Route::resource('skills',SkillController::class);
    Route::apiResource('locations', LocationController::class)->middleware(CheckAdminMiddleware::class);
});
