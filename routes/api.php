<?php

use App\Http\Controllers\Api\ApplicantJobCategory\ApplicantJobCategoryController;
use App\Http\Controllers\Api\ApplicantProfile\ApplicantProfileController;
use App\Http\Controllers\Api\ApplicantSkill\ApplicantSkillController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CompanyProfile\CompanyProfileController;
use App\Http\Controllers\Api\JobCategory\JobCategoryController;
use App\Http\Controllers\Api\Jobs\JobController;
use App\Http\Controllers\Api\Locations\LocationController;
use App\Http\Controllers\Api\Resumes\ResumeController;
use App\Http\Controllers\Api\Review\ReviewController;
use App\Http\Controllers\Api\SavedJob\SavedJobController;
use App\Http\Controllers\Api\Skills\SkillController;
use App\Http\Controllers\ApplicantEducation\ApplicantEducationController;
use App\Http\Controllers\ApplicantExperience\ApplicantExperienceController;
use App\Http\Controllers\Application\ApplicationController;
use App\Http\Controllers\SocialMedia\SocialMediaController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\CheckRecruiterMiddleware;
use App\Http\Middleware\JWTMiddleware;
use App\Http\Middleware\MustBeApplicant;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/')->group(function () {
    Route::prefix('/auth')->name('auth.')->group(function () {
        Route::post('signup', [AuthController::class, 'register'])->name('register');
        Route::post('signin', [AuthController::class, 'login'])->name('sign');
        Route::post('signout', [AuthController::class, 'logout'])->middleware(JWTMiddleware::class);
        Route::get('user', [AuthController::class, 'getUser'])->middleware(JWTMiddleware::class);
        Route::post('password/change', [AuthController::class, 'changePassword']);
    });

    Route::middleware([JWTMiddleware::class])->group(function () {
        /** Information */
        Route::resource('skills', SkillController::class);
        Route::apiResource('social-media', SocialMediaController::class);

        /** Admin */
        Route::prefix('admin/')->middleware([CheckAdminMiddleware::class])->group(function () {
            Route::resource('job-categories', JobCategoryController::class);
            Route::apiResource('locations', LocationController::class);
        });

        /** Recruiter Profile */
        Route::prefix('recruiter/me/')->middleware([CheckRecruiterMiddleware::class])->group(function () {
            Route::get('', [CompanyProfileController::class, 'index']);
            Route::put('', [CompanyProfileController::class, 'store']);
            Route::get('reviews', [CompanyProfileController::class, 'getReviews']);
            // Route::get('profile/{id}', [CompanyProfileController::class, 'show']);
            // Route::put('profile/{id}', [CompanyProfileController::class, 'update']);
            // Route::delete('profile/{id}', [CompanyProfileController::class, 'destroy']);
            Route::apiResource('jobs', JobController::class);
            Route::get('jobs/{job_id}/applications', [JobController::class, 'applications']);
            Route::get('jobs/{job_id}/shortlist', [JobController::class, 'applications']);
            Route::patch('applications/{id}/status', [ApplicationController::class, 'updateStatus']);
        });

        /** Applicant Profile */
        Route::prefix('applicant/me')->middleware(MustBeApplicant::class)->group(function () {
            Route::apiResource('', ApplicantProfileController::class);
            Route::apiResource('educations', ApplicantEducationController::class);
            Route::apiResource('experiences', ApplicantExperienceController::class);
            Route::apiResource('resumes', ResumeController::class);
            Route::apiResource('skills', ApplicantSkillController::class);
            Route::apiResource('job-categories', ApplicantJobCategoryController::class);
            Route::post('saves', [SavedJobController::class, 'toggleSaveJob']);
            Route::apiResource('applications', ApplicationController::class);
        });

        Route::prefix("recruiters/")->group(function () {
            Route::get('', [ReviewController::class, 'index']);
            Route::get('{id}', [ReviewController::class, 'show']);
            Route::get('{id}/jobs', [ReviewController::class, 'jobs']);
            Route::apiResource('{id}/reviews', ReviewController::class)->middleware(MustBeApplicant::class);
        });

        Route::prefix("accounts/")->group(function () {
            Route::get('', [ReviewController::class, 'index']);
            Route::get('{id}', [ReviewController::class, 'show']);
        });
    });

//Route::apiResource('applicant-skill',ApplicantSkillController::class);

    Route::middleware(JWTMiddleware::class)->group(function () {

    });

});
