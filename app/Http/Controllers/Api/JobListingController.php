<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    /**
     * Display a listing of the job listings.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $jobListings = JobListing::with('tags', 'skills', 'category')->get();

        return response()->json($jobListings);
    }

    /**
     * Display the specified job listing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $jobListing = JobListing::with('tags', 'skills', 'category')->findOrFail($id);

        return response()->json($jobListing);
    }
}
