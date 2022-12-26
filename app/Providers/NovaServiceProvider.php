<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use HasTabs;

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

        # Menu
        Nova::mainMenu(function (Request $request) {

            return [
                MenuSection::dashboard(\App\Nova\Dashboards\Main::class)->icon('chart-bar'),
                MenuSection::make('Usuários', [
                    MenuItem::resource(\App\Nova\Models\User\User::class),
                    MenuItem::resource(\App\Nova\Models\User\UserFollow::class),
                    MenuItem::resource(\App\Nova\Models\User\UserInterest::class),
                    MenuItem::resource(\App\Nova\Models\User\UserStatus::class),
                ])->icon('user')->collapsable(),

                MenuSection::make('Publicações', [
                    MenuItem::resource(\App\Nova\Models\Publication\Publication::class),
                    MenuItem::resource(\App\Nova\Models\Publication\PublicationStatistics::class),
                    MenuItem::resource(\App\Nova\Models\Publication\PublicationLike::class),
                    MenuItem::resource(\App\Nova\Models\Publication\PublicationComment::class),
                    MenuItem::resource(\App\Nova\Models\Publication\PublicationReport::class),
                ])->icon('photograph')->collapsable(),

                MenuSection::make('Salas', [
                    MenuItem::resource(\App\Nova\Models\Room\Room::class),
                    MenuItem::resource(\App\Nova\Models\User\UserRoom::class),
                ])->icon('chat-alt-2')->collapsable(),

                MenuSection::make('Dados', [
                    MenuItem::resource(\App\Nova\Models\Data\DataCountry::class),
                    MenuItem::resource(\App\Nova\Models\Data\DataGenre::class),
                    MenuItem::resource(\App\Nova\Models\Data\DataInterest::class),
                    MenuItem::resource(\App\Nova\Models\Data\DataPrivacyType::class),
                    MenuItem::resource(\App\Nova\Models\Data\DataPrivacyTypeOption::class),
                ])->icon('database')->collapsable(),

            ];
        });

        // Footer
        Nova::footer(function ($request) {
            return Blade::render('
                <div class="mt-8 leading-normal text-xs text-gray-500 space-y-1">
                    <p class="text-center">Desenvolvido por Intellectus</p>
                    <p class="text-center">© 2022 intellectus.com</p>
                </div>
            ');
        });
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
