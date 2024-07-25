<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the applications for a specific job listing.
     *
     * @param  int  $jobListingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($jobListingId)
    {
        $applications = Application::where('job_listing_id', $jobListingId)
            ->with('candidate') // Assuming a relationship to Candidate model
            ->get();

        return response()->json($applications);
    }

    /**
     * Display the specified application.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $application = Application::with('candidate')
            ->findOrFail($id);

        return response()->json($application);
    }

    /**
     * Store a newly created application in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_listing_id' => 'required|exists:job_listings,id',
            'candidate_id' => 'required|exists:candidates,id',
            'cover_letter' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $application = new Application();
        $application->job_listing_id = $request->input('job_listing_id');
        $application->candidate_id = $request->input('candidate_id');
        $application->cover_letter = $request->input('cover_letter');

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $application->resume = $resumePath;
        }

        $application->save();

        return response()->json($application, 201);
    }

    /**
     * Update the specified application in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'cover_letter' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $application = Application::findOrFail($id);
        $application->cover_letter = $request->input('cover_letter');

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $application->resume = $resumePath;
        }

        $application->save();

        return response()->json($application);
    }

    /**
     * Remove the specified application from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return response()->json(['message' => 'Application deleted successfully']);
    }
}
