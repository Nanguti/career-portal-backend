<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'profile_picture',
        'linkedin_profile',
        'experience',
        'education',
        'date_of_birth',
        'nationality',
        'gender',
        'status',
    ];

    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function documents()
    {
        return $this->hasMany(CandidateDocument::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
