<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateInterview extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'interview_date',
        'interviewer_id',
        'status',
        'notes'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function interviewer()
    {
        return $this->belongsTo(User::class);
    }
}
