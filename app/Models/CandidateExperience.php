<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'job_title',
        'company',
        'start_date',
        'end_date',
        'responsibilities',
    ];
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
