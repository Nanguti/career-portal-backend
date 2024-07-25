<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class JobApplicationController extends Controller
{
    /**
     * Store a newly created job application in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'candidate_id' => 'required|exists:candidates,id',
            'job_listing_id' => 'required|exists:job_listings,id',
            'status' => 'required|string|in:applied,interviewed,offered,accepted,rejected',
            'application_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $application = Application::create($request->all());

        return response()->json($application, Response::HTTP_CREATED);
    }

    /**
     * Display the specified job application.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Application $application)
    {
        return response()->json($application);
    }

    /**
     * Update the specified job application in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Application $application)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'sometimes|string|in:applied,interviewed,offered,accepted,rejected',
            'application_date' => 'sometimes|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $application->update($request->all());

        return response()->json($application);
    }

    /**
     * Remove the specified job application from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return response()->json(['message' => 'Job application deleted successfully']);
    }

    /**
     * Get all applications for a specific candidate.
     *
     * @param  int  $candidateId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getApplicationsByCandidate($candidateId)
    {
        $applications = Application::where('candidate_id', $candidateId)->get();

        return response()->json($applications);
    }

    /**
     * Get all applications for a specific job listing.
     *
     * @param  int  $jobListingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getApplicationsByJobListing($jobListingId)
    {
        $applications = Application::where('job_listing_id', $jobListingId)->get();

        return response()->json($applications);
    }
}
