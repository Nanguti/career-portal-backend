<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CandidateDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CandidateDocumentController extends Controller
{
    /**
     * Store a newly created document in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'candidate_id' => 'required|exists:candidates,id',
            'document' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $file = $request->file('document');
        $filePath = $file->store('candidate_documents', 'public');

        $document = CandidateDocument::create([
            'candidate_id' => $request->input('candidate_id'),
            'type' => $request->input('type'),
            'path' => $filePath,
        ]);

        return response()->json($document, Response::HTTP_CREATED);
    }

    /**
     * Display the specified document.
     *
     * @param  \App\Models\CandidateDocument  $candidateDocument
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(CandidateDocument $candidateDocument)
    {
        if (!Storage::disk('public')->exists($candidateDocument->path)) {
            return response()->json(['message' => 'Document not found'], Response::HTTP_NOT_FOUND);
        }

        $url = Storage::disk('public')->url($candidateDocument->path);

        return response()->json(['url' => $url]);
    }

    /**
     * Remove the specified document from storage.
     *
     * @param  \App\Models\CandidateDocument  $candidateDocument
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CandidateDocument $candidateDocument)
    {
        if (Storage::disk('public')->exists($candidateDocument->path)) {
            Storage::disk('public')->delete($candidateDocument->path);
        }

        $candidateDocument->delete();

        return response()->json(['message' => 'Document deleted successfully']);
    }
}
