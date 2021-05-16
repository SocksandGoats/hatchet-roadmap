<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Inspheric\Fields\Url;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Idea extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Idea::class;

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
        'title',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Stack::make('Title', 'title', [
                Line::make('Title')->asHeading(),
                Url::make('Slug', 'slug', fn($value) => route('idea.show', $value))->alwaysClickable()
            ])->sortable()->onlyOnIndex(),

            Text::make('Title')
                ->rules('required', 'max:254')
                ->hideFromIndex(),

            Slug::make('Slug')
                ->from('Title')
                ->hideFromIndex(),

            Trix::make('Description')
                ->withFiles('public')
                ->rules('required')
                ->alwaysShow(),

            BelongsTo::make('User')->sortable(),

            BelongsTo::make('Category')->sortable(),

            BelongsTo::make('Status')->sortable(),

            Number::make('Spam Reports')
                ->exceptOnForms()
                ->sortable(),

            HasMany::make('Comments')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
