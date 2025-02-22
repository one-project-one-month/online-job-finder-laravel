<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JWTMiddleware;
use App\Http\Middleware\MustBeApplicant;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Middleware\CheckRecruiterMiddleware;
use App\Http\Controllers\Api\Skills\SkillController;
use App\Http\Controllers\Api\Resumes\ResumeController;
use App\Http\Controllers\Api\Locations\LocationController;
use App\Http\Controllers\SocialMedia\SocialMediaController;
use App\Http\Controllers\Api\JobCategory\JobCategoryController;
use App\Http\Controllers\Api\ApplicantSkill\ApplicantSkillController;
use App\Http\Controllers\Api\CompanyProfile\CompanyProfileController;
use App\Http\Controllers\Api\ApplicantProfile\ApplicantProfileController;
use App\Http\Controllers\ApplicantEducation\ApplicantEducationController;
use App\Http\Controllers\Api\ApplicantJobCategory\ApplicantJobCategoryController;


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
});

Route::prefix('recruiter/me/')->middleware([JWTMiddleware::class])->group(function(){
    Route::get('profile',[CompanyProfileController::class,'index']);
    Route::post('profile',[CompanyProfileController::class,'store'])->middleware(CheckRecruiterMiddleware::class);
    Route::get('profile',[CompanyProfileController::class,'show']);
    Route::put('profile',[CompanyProfileController::class,'update'])->middleware(CheckRecruiterMiddleware::class);
});

Route::prefix('admin/me')->middleware(JWTMiddleware::class)->group(function (){
    Route::resource('jobCategories',JobCategoryController::class)->middleware(CheckAdminMiddleware::class);
    Route::resource('skills',SkillController::class);
    Route::apiResource('locations', LocationController::class)->middleware(CheckAdminMiddleware::class);
});

Route::prefix('applicant/me')->middleware(JWTMiddleware::class)->group(function(){
    Route::apiResource('profile',ApplicantProfileController::class)->middleware(MustBeApplicant::class);
    Route::apiResource('education',ApplicantEducationController::class)->middleware(MustBeApplicant::class);
    Route::apiResource('resumes', ResumeController::class)->middleware(JWTMiddleware::class);
    Route::apiResource('applicant-skill',ApplicantSkillController::class)->middleware(MustBeApplicant::class);
});


//Route::apiResource('applicant-skill',ApplicantSkillController::class);

Route::middleware(JWTMiddleware::class)->group(function(){
    Route::apiResource('social-media',SocialMediaController::class);
});

Route::post('/applicant-job-categories', [ApplicantJobCategoryController::class, 'store']);





