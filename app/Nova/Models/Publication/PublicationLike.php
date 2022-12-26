<?php

namespace App\Nova\Models\Publication;

use App\Nova\Metrics\CountModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Resource;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;

class PublicationLike extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Publication\PublicationLike::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];


    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Curtidas');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('curtida');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('Usuário', 'user', 'App\Nova\Models\User\User')
                ->searchable()
                ->withSubtitles(),

            BelongsTo::make('Publicação', 'publication', 'App\Nova\Models\Publication\Publication')
                ->searchable()
                ->withSubtitles(),
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
        return [
            (new CountModel(\App\Models\Publication\PublicationLike::class,'Total de curtidas'))->width('1/2')->icon('thumb-up'),
        ];
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

    /**
     * Authorize to create
     */
    public static function authorizedToCreate(Request $request)
    {
        return true;
    }

    /**
     * Authorize to delete
     */
    public function authorizedToDelete(Request $request)
    {
        return true;
    }

    /**
     * Authorize to delete
     */
    public function authorizedToUpdate(Request $request)
    {
        return true;
    }

    /**
     * Authorize to replicate
     */
    public function authorizedToReplicate(Request $request)
    {
        return false;
    }
}