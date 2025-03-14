<?php

use App\Http\Controllers\Api\ApplicantJobCategory\ApplicantJobCategoryController;
use App\Http\Controllers\Api\ApplicantList\ApplicantListController;
use App\Http\Controllers\Api\ApplicantProfile\ApplicantProfileController;
use App\Http\Controllers\Api\ApplicantSkill\ApplicantSkillController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\UserController;
use App\Http\Controllers\Api\CompanyProfile\CompanyProfileController;
use App\Http\Controllers\Api\JobCategory\JobCategoryController;
use App\Http\Controllers\Api\JobList\JobListController;
use App\Http\Controllers\Api\Jobs\JobController;
use App\Http\Controllers\Api\Locations\LocationController;
use App\Http\Controllers\Api\Resumes\ResumeController;
use App\Http\Controllers\Api\Review\ReviewController;
use App\Http\Controllers\Api\Role\RoleController;
use App\Http\Controllers\Api\SavedJob\SavedJobController;
use App\Http\Controllers\Api\Skills\SkillController;
use App\Http\Controllers\ApplicantEducation\ApplicantEducationController;
use App\Http\Controllers\ApplicantExperience\ApplicantExperienceController;
use App\Http\Controllers\Application\ApplicationController;
use App\Http\Controllers\SocialMedia\SocialMediaController;
use App\Http\Middleware\CheckRecruiterMiddleware;
use App\Http\Middleware\IsActivated;
use App\Http\Middleware\JWTMiddleware;
use App\Http\Middleware\MustBeApplicant;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/')->group(function () {
    Route::prefix('/auth')->name('auth.')->group(function () {
        Route::post('signup', [AuthController::class, 'register'])->name('register');
        Route::post('signin', [AuthController::class, 'login'])->name('sign');
        Route::post('signout', [AuthController::class, 'logout'])->middleware(JWTMiddleware::class);
        Route::get('user', [AuthController::class, 'getUser'])->middleware(JWTMiddleware::class);
        Route::post('user/profile-upload', [UserController::class, 'uploadProfile'])->middleware(JWTMiddleware::class);
        Route::post('password/change', [AuthController::class, 'changePassword'])->middleware(JWTMiddleware::class);
    });

    Route::middleware([JWTMiddleware::class, IsActivated::class])->group(function () {
        /** Information */
        Route::get('available-roles', [RoleController::class, 'getAvailableRoles'])->name('roles.available')->withoutMiddleware(IsActivated::class);
        Route::resource('skills', SkillController::class);
        Route::apiResource('social-media', SocialMediaController::class);

        /** Admin */
        Route::prefix('admin/')->group(function () {
            Route::resource('job-categories', JobCategoryController::class);
            Route::apiResource('locations', LocationController::class);
        });

        /** Applicant Profile */
        Route::prefix('applicant/me')->middleware(MustBeApplicant::class)->group(function () {
            Route::get('', [ApplicantProfileController::class, 'getMyApplicantProfile'])->name('me')->withoutMiddleware(IsActivated::class);
            Route::put('', [ApplicantProfileController::class, 'updateMyApplicantProfile'])->name('me.update')->withoutMiddleware(IsActivated::class);
            Route::apiResource('educations', ApplicantEducationController::class);
            Route::apiResource('experiences', ApplicantExperienceController::class);
            Route::apiResource('resumes', ResumeController::class);
            Route::get('default-resume', [ResumeController::class, 'getDefaultResume']);
            Route::apiResource('skills', ApplicantSkillController::class);
            Route::apiResource('job-categories', ApplicantJobCategoryController::class);
            Route::get('saves', [SavedJobController::class, 'index']);
            Route::apiResource('applications', ApplicationController::class);
        });

        /** Recruiter Profile */
        Route::prefix('recruiter/me/')->name('recruiter.')->middleware([CheckRecruiterMiddleware::class])->group(function () {
            Route::get('', [CompanyProfileController::class, 'getMyCompanyProfile'])->name('me')->withoutMiddleware(IsActivated::class);
            Route::put('', [CompanyProfileController::class, 'updateMyCompanyProfile'])->name('me.update')->withoutMiddleware(IsActivated::class);
            Route::get('reviews', [CompanyProfileController::class, 'getReviews'])->name('reviews');
            Route::apiResource('jobs', JobController::class);
            Route::get('jobs/{job_id}/applications', [JobController::class, 'getApplications'])->name('jobs.show.applications')->withoutMiddleware(IsActivated::class);
            Route::get('jobs/{job_id}/shortlist', [JobController::class, 'getShortList'])->name('jobs.show.shortlist');
            Route::patch('applications/{id}/status', [ApplicationController::class, 'updateStatus'])->name('applications.status.update');
        });

        /** Recruiters */
        Route::prefix("recruiters/")->name('recruiters.')->group(function () {
            Route::get('', [CompanyProfileController::class, 'index'])->name('index');
            Route::get('{id}', [CompanyProfileController::class, 'show'])->name('show');
            Route::get('{id}/jobs', [CompanyProfileController::class, 'getJobs'])->name('jobs');
            Route::apiResource('{company_id}/reviews', ReviewController::class);
        });

        /** Applicants */
        Route::prefix("accounts/")->group(function () {
            Route::get('', [ApplicantListController::class, 'index']);
            Route::get('{id}', [ApplicantListController::class, 'show']);
        });

        /** Jobs */
        Route::get('jobs', [JobListController::class, 'index']);
        Route::get('jobs/{id}', [JobListController::class, 'show']);
        Route::post('jobs/{id}/save', [JobListController::class, 'toggleSaveJob']);
        Route::post('jobs/{job_post_id}/apply', [ApplicationController::class, 'store']);
    });
});
