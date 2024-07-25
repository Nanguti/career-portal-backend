<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CandidateEducation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CandidateEducationController extends Controller
{
    /**
     * Store a newly created education record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'candidate_id' => 'required|exists:candidates,id',
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $education = CandidateEducation::create($request->all());

        return response()->json($education, Response::HTTP_CREATED);
    }

    /**
     * Display the specified education record.
     *
     * @param  \App\Models\CandidateEducation  $candidateEducation
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(CandidateEducation $candidateEducation)
    {
        return response()->json($candidateEducation);
    }

    /**
     * Update the specified education record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CandidateEducation  $candidateEducation
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, CandidateEducation $candidateEducation)
    {
        $validator = Validator::make($request->all(), [
            'degree' => 'sometimes|string|max:255',
            'institution' => 'sometimes|string|max:255',
            'start_date' => 'sometimes|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $candidateEducation->update($request->all());

        return response()->json($candidateEducation);
    }

    /**
     * Remove the specified education record from storage.
     *
     * @param  \App\Models\CandidateEducation  $candidateEducation
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CandidateEducation $candidateEducation)
    {
        $candidateEducation->delete();

        return response()->json(['message' => 'Education record deleted successfully']);
    }
}
