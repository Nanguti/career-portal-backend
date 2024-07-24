<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateDocument extends Model
{
    use HasFactory;
    protected $table = 'candidate_documents';

    protected $fillable = [
        'candidate_id',
        'document_type',
        'filename',
        'file_size',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
