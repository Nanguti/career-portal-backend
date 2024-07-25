<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CandidateExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CandidateExperienceController extends Controller
{
    /**
     * Store a newly created candidate experience in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'candidate_id' => 'required|exists:candidates,id',
            'company_name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $experience = CandidateExperience::create($request->all());

        return response()->json($experience, Response::HTTP_CREATED);
    }

    /**
     * Display the specified candidate experience.
     *
     * @param  \App\Models\CandidateExperience  $candidateExperience
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(CandidateExperience $candidateExperience)
    {
        return response()->json($candidateExperience);
    }

    /**
     * Update the specified candidate experience in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CandidateExperience  $candidateExperience
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, CandidateExperience $candidateExperience)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'sometimes|string|max:255',
            'job_title' => 'sometimes|string|max:255',
            'start_date' => 'sometimes|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $candidateExperience->update($request->all());

        return response()->json($candidateExperience);
    }

    /**
     * Remove the specified candidate experience from storage.
     *
     * @param  \App\Models\CandidateExperience  $candidateExperience
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CandidateExperience $candidateExperience)
    {
        $candidateExperience->delete();

        return response()->json(['message' => 'Candidate experience deleted successfully']);
    }

    /**
     * Get all experiences for a specific candidate.
     *
     * @param  int  $candidateId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExperiencesByCandidate($candidateId)
    {
        $experiences = CandidateExperience::where('candidate_id', $candidateId)->get();

        return response()->json($experiences);
    }
}
