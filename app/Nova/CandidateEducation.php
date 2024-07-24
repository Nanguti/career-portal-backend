<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class CandidateEducation extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\CandidateEducation>
     */
    public static $model = \App\Models\CandidateEducation::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'degree';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'degree',
        'institution',
        'field_of_study',
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

            BelongsTo::make('Candidate')
                ->rules('required'),

            Text::make('Degree')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Institution')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Field of Study')
                ->sortable()
                ->rules('required', 'max:255'),

            Date::make('Start Date')
                ->rules('required', 'date'),

            Date::make('End Date')
                ->nullable()
                ->rules('date'),

            Text::make('Grade')
                ->nullable()
                ->rules('max:255'),

            Text::make('Description')
                ->nullable()
                ->rules('max:65535'),
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
