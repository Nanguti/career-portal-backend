<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'requirements',
        'location',
        'salary',
        'status',
        'application_deadline',
    ];

    protected $casts = [
        'application_deadline' => 'date',
    ];
    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(JobListingTag::class, 'job_listing_job_listing_tag');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function jobCategoryType()
    {
        return $this->belongsTo(JobCategoryType::class);
    }
}
