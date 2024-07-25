<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    AuthController,
    CandidateController,
    CandidateDocumentController,
    CandidateEducationController,
    CandidateExperienceController,
    ApplicationController,
    JobListingController,
    CandidateInterviewController,
    FeedbackController
};

// Authentication
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::get('/auth/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

// Candidate Profile
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/candidates/profile', [CandidateController::class, 'profile']);
    Route::put('/candidates/profile', [CandidateController::class, 'updateProfile']);

    // Candidate Documents
    Route::get('/candidates/documents', [CandidateDocumentController::class, 'index']);
    Route::post('/candidates/documents', [CandidateDocumentController::class, 'store']);
    Route::delete('/candidates/documents/{id}', [CandidateDocumentController::class, 'destroy']);

    // Candidate Education
    Route::get('/candidates/education', [CandidateEducationController::class, 'index']);
    Route::post('/candidates/education', [CandidateEducationController::class, 'store']);
    Route::put('/candidates/education/{id}', [CandidateEducationController::class, 'update']);
    Route::delete('/candidates/education/{id}', [CandidateEducationController::class, 'destroy']);

    // Candidate Experience
    Route::get('/candidates/experience', [CandidateExperienceController::class, 'index']);
    Route::post('/candidates/experience', [CandidateExperienceController::class, 'store']);
    Route::put('/candidates/experience/{id}', [CandidateExperienceController::class, 'update']);
    Route::delete('/candidates/experience/{id}', [CandidateExperienceController::class, 'destroy']);

    // Candidate Applications
    Route::get('/applications', [ApplicationController::class, 'index']);
    Route::post('/applications', [ApplicationController::class, 'store']);
    Route::get('/applications/{id}', [ApplicationController::class, 'show']);

    // Candidate Interviews
    Route::get('/candidates/interviews', [CandidateInterviewController::class, 'index']);
    Route::get('/candidates/interviews/{id}', [CandidateInterviewController::class, 'show']);

    // Feedback
    Route::post('/feedback', [FeedbackController::class, 'store']);
});

// Job Listings
Route::get('/job-listings', [JobListingController::class, 'index']);
Route::get('/job-listings/{id}', [JobListingController::class, 'show']);
