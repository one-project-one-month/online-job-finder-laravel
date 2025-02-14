<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JobCategory\JobCategoryController;

use App\Http\Controllers\Api\Locations\LocationController;

use App\Http\Controllers\Api\Skills\SkillController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('jobCategories',JobCategoryController::class);

Route::resource('skills',SkillController::class);




Route::apiResource('locations', LocationController::class);
