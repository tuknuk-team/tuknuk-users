<?php

namespace App\Nova\Models\Publication;

use App\Models\User;
use App\Nova\Actions\ChangeStatusModel;
use App\Nova\Metrics\CountModel;
use App\Nova\Metrics\CountModelByDays;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Resource;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\Traits\HasTabs;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Textarea;

class Publication extends Resource
{
    use HasTabs;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Publication\Publication::class;


    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        return '@'.$this->user->username.' ('.$this->uuid.')';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'uuid',
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Publicações');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Publicação');
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
            Text::make('UUID','uuid')
                ->sortable(),

            BelongsTo::make('Usuário', 'user', 'App\Nova\Models\User\User')
                ->searchable()
                ->withSubtitles(),

            BelongsTo::make('Tipo', 'type', 'App\Nova\Models\Publication\PublicationType')
                ->searchable()
                ->withSubtitles(),

            BelongsTo::make('Status', 'status', 'App\Nova\Models\Publication\PublicationStatus')
                ->searchable()
                ->withSubtitles(),


            Textarea::make('Texto','text'),


            Badge::make('Privado', 'is_private', function () {
                    return $this->is_private ? 'Sim' : 'Não';
                })->map([
                    'Não' => 'info',
                    'Sim' => 'success'
                ]),

            Badge::make('Rascunho', 'is_draft', function () {
                    return $this->is_draft ? 'Sim' : 'Não';
                })->map([
                    'Não' => 'info',
                    'Sim' => 'success'
                ]),

            Badge::make('Spoiler', 'is_spoiler', function () {
                    return $this->is_spoiler ? 'Sim' : 'Não';
                })->map([
                    'Não' => 'info',
                    'Sim' => 'success'
                ]),

            HasOne::make('Estáticas', 'statistics', 'App\Nova\Models\Publication\PublicationStatistics')
                ->exceptOnForms(),

            HasOne::make('Sala', 'room', 'App\Nova\Models\Room\Room')
                ->exceptOnForms(),

            Tabs::make('Detalhes', [
                HasMany::make('Curtidas', 'likes', 'App\Nova\Models\Publication\PublicationLike')
                    ->exceptOnForms()
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
            (new CountModel(\App\Models\Publication\Publication::class,'Total de publicações'))->width('1/4')->icon('photograph'),
            (new CountModel(\App\Models\Publication\PublicationReport::class,'Total de denuncias'))->width('1/4')->icon('exclamation-circle'),
            (new CountModel(\App\Models\Publication\PublicationLike::class,'Total de curtidas'))->width('1/4')->icon('thumb-up'),
            (new CountModel(\App\Models\Publication\PublicationComment::class,'Total de comentários'))->width('1/4')->icon('chat'),
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
        return [
            new ChangeStatusModel(\App\Models\Publication\PublicationStatus::get(),'Alterar status da publicação')
        ];
    }

    /**
     * Authorize to create
     */
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    /**
     * Authorize to delete
     */
    public function authorizedToDelete(Request $request)
    {
        return false;
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
