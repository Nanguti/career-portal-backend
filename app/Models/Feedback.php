<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    protected $fillable = [
        'application_id',
        'candidate_id',
        'rating',
        'comments',
    ];

    // Optional: Define relationships
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
