<?php

namespace App\Providers;

use App\Nova\CandidateInterview;
use App\Nova\Dashboards\Main;
use App\Nova\JobCategory;
use App\Nova\JobCategoryType;
use App\Nova\JobListing;
use App\Nova\JobListingTag;
use App\Nova\JobSkill;
use App\Nova\User;
use App\Nova\Application;
use App\Nova\CandidateDocument;
use App\Nova\CandidateEducation;
use App\Nova\Feedback;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Illuminate\Http\Request;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),
                MenuSection::make('User Management', [
                    MenuItem::resource(User::class),
                ])->icon('user')->collapsable(),
                MenuSection::make('Job Management', [
                    MenuItem::resource(JobCategory::class),
                    MenuItem::resource(JobCategoryType::class),
                    MenuItem::resource(JobListing::class),
                    MenuItem::resource(JobListingTag::class),
                    MenuItem::resource(JobSkill::class),
                ])->icon('user')->collapsable(),

                MenuSection::make('Candidate Management', [
                    MenuItem::resource(Application::class),
                    MenuItem::resource(CandidateEducation::class),
                    MenuItem::resource(CandidateDocument::class),
                    MenuItem::resource(CandidateInterview::class),
                    MenuItem::resource(Feedback::class),
                ])->icon('user')->collapsable(),

            ];
        });

        Nova::style('prism-css', asset('assets/prism.css'));
        Nova::style('prism-css', asset('assets/custom.css'));
        Nova::script('prism-js', asset('assets/prism.js'));
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
