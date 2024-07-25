<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CandidateInterview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CandidateInterviewController extends Controller
{
    /**
     * Store a newly created interview record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'candidate_id' => 'required|exists:candidates,id',
            'interviewer' => 'required|string|max:255',
            'interview_date' => 'required|date',
            'feedback' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $interview = CandidateInterview::create($request->all());

        return response()->json($interview, Response::HTTP_CREATED);
    }

    /**
     * Display the specified interview record.
     *
     * @param  \App\Models\CandidateInterview  $candidateInterview
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(CandidateInterview $candidateInterview)
    {
        return response()->json($candidateInterview);
    }

    /**
     * Update the specified interview record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CandidateInterview  $candidateInterview
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, CandidateInterview $candidateInterview)
    {
        $validator = Validator::make($request->all(), [
            'interviewer' => 'sometimes|string|max:255',
            'interview_date' => 'sometimes|date',
            'feedback' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $candidateInterview->update($request->all());

        return response()->json($candidateInterview);
    }

    /**
     * Remove the specified interview record from storage.
     *
     * @param  \App\Models\CandidateInterview  $candidateInterview
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CandidateInterview $candidateInterview)
    {
        $candidateInterview->delete();

        return response()->json(['message' => 'Interview record deleted successfully']);
    }
}
