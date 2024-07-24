<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListingTag extends Model
{
    use HasFactory;
    protected $table = 'job_listing_tags';

    protected $fillable = [
        'tag_name',
    ];
    public function jobListings()
    {
        return $this->belongsToMany(JobListing::class, 'job_listing_job_listing_tag');
    }
}
