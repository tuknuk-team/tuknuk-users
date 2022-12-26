<?php

namespace App\Nova\Models\User;

use App\Nova\Metrics\CountModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Resource;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;

class UserFollow extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User\UserFollow::class;

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
        return __('Seguidores');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Seguidor');
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

            BelongsTo::make('Seguindo', 'userFollow', 'App\Nova\Models\User\User')
                ->searchable()
                ->withSubtitles(),

            Badge::make('Status', 'approved', function () {
                    return $this->approved ? 'Seguindo' : 'Pendente';
                })->map([
                    'Pendente' => 'warning',
                    'Seguindo' => 'success'
                ]),
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
            (new CountModel(\App\Models\User\UserFollow::class,'Total de seguidores'))->width('1/3')->icon('badge-check'),
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
        return false;
    }

    /**
     * Authorize to replicate
     */
    public function authorizedToReplicate(Request $request)
    {
        return false;
    }
}
