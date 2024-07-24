<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\JobApplicationController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\UserController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('jobs', [JobController::class, 'index']);
Route::get('jobs/{id}', [JobController::class, 'show']);
Route::get('jobs/search', [JobController::class, 'search']);
Route::post('jobs/{id}/apply', [JobApplicationController::class, 'apply']);

Route::post('users/register', [UserController::class, 'register']);
Route::post('users/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->get('users/profile', [UserController::class, 'profile']);
Route::middleware('auth:sanctum')->put('users/profile', [UserController::class, 'update']);

Route::post('feedback', [FeedbackController::class, 'store']);
