<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Candidate extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Candidate>
     */
    public static $model = \App\Models\Candidate::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'email',
        'phone_number',
        'linkedin_profile',
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

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:candidates,email')
                ->updateRules('unique:candidates,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Text::make('Phone Number')
                ->sortable()
                ->rules('nullable', 'max:15'),

            Textarea::make('Address')
                ->hideFromIndex(),

            Image::make('Profile Picture')
                ->disk('public')
                ->prunable()
                ->hideFromIndex(),

            Text::make('LinkedIn Profile')
                ->sortable()
                ->rules('nullable', 'url', 'max:255'),

            Textarea::make('Experience')
                ->hideFromIndex(),

            Textarea::make('Education')
                ->hideFromIndex(),

            Date::make('Date of Birth')
                ->sortable()
                ->rules('nullable', 'date'),

            Text::make('Nationality')
                ->sortable()
                ->rules('nullable', 'max:255'),

            Select::make('Gender')
                ->sortable()
                ->options([
                    'Male' => 'Male',
                    'Female' => 'Female',
                    'Other' => 'Other',
                ])
                ->rules('nullable'),

            Select::make('Status')
                ->sortable()
                ->options([
                    'Active' => 'Active',
                    'Inactive' => 'Inactive',
                ])
                ->default('Active')
                ->rules('required'),

            HasMany::make('Documents', 'documents', CandidateDocument::class),
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
