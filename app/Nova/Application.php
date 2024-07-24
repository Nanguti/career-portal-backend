<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;
use Laravel\Nova\Http\Requests\NovaRequest;

class Application extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Application::class;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'status',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Candidate')
                ->sortable()
                ->searchable()
                ->rules('required'),

            BelongsTo::make('Job Listing', 'jobListing', JobListing::class)
                ->sortable()
                ->searchable()
                ->rules('required'),

            Date::make('Application Date')
                ->sortable()
                ->rules('required', 'date'),

            Text::make('Status')
                ->sortable()
                ->rules('required', 'max:255'),
        ];
    }
}
