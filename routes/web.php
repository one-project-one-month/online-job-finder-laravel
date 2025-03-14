<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('uploads/{any}', function ($any) {
    return Storage::disk('public')->response($any);
})->where('any', '.*');