<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Partition\ApplicationsByJobListing;
use App\Nova\Metrics\Partition\FeedbackByJobListing;
use App\Nova\Metrics\Partition\JobListingsByCategory;
use App\Nova\Metrics\Trend\Application as TrendApplication;
use App\Nova\Metrics\Trend\Candidate as TrendCandidate;
use App\Nova\Metrics\Trend\CandidateInterview;
use App\Nova\Metrics\Value\Application;
use App\Nova\Metrics\Value\Candidate;
use App\Nova\Metrics\Value\JobListing;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new JobListing,
            new Application,
            new Candidate,
            new TrendApplication,
            new TrendCandidate,
            new \App\Nova\Metrics\Trend\JobListing,
            new ApplicationsByJobListing,
            new JobListingsByCategory,
            new FeedbackByJobListing,

        ];
    }
}
