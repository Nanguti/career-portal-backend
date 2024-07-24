<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateEducation extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'degree',
        'institution',
        'field_of_study',
        'start_date',
        'end_date',
        'grade',
        'description',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
