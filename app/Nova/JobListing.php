<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Murdercode\TinymceEditor\TinymceEditor;

class JobListing extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\JobListing>
     */
    public static $model = \App\Models\JobListing::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'description', 'location'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Title')
                ->rules('required', 'string', 'max:255'),

            TinymceEditor::make(__('Description'), 'description')
                ->rules(['required', 'min:20'])
                ->help(__('Job Description.')),

            TinymceEditor::make(__('Responsibilities'), 'responsibilities')
                ->rules(['required', 'min:20'])
                ->help(__('Job Responsibilities')),

            TinymceEditor::make(__('Requirements'), 'requirements')
                ->rules(['required', 'min:20'])
                ->help(__('The Job Requirements.')),

            Text::make('Location')
                ->rules('required', 'string', 'max:255'),

            Number::make('Salary')
                ->nullable()
                ->rules('numeric'),

            Text::make('Status')
                ->rules('required', 'string', 'max:255'),

            Date::make('Application Deadline')
                ->rules('required', 'date'),

            BelongsTo::make('Job Category', 'jobCategory', JobCategory::class),

            BelongsTo::make('Job Type', 'jobCategoryType', JobCategoryType::class),

            BelongsToMany::make('Tags', 'tags', JobListingTag::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
