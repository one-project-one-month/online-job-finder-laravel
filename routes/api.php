<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JobCategory\JobCategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// routes/web.php



Route::post('job-categories', [JobCategoryController::class, 'create']);
Route::get('job-categories', [JobCategoryController::class, 'getall']);
Route::get('job-categories/{id}', [JobCategoryController::class, 'get']);
Route::put('job-categories/{id}', [JobCategoryController::class, 'update']);
Route::delete('job-categories/{id}', [JobCategoryController::class, 'delete']);

