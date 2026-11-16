<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return base_path('public');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['layout.layout', 'layout.layout-react-public', 'layout.layout-material-public', 'layout.layout-profile', 'errors.layout', 'app'], function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', collect(config('app.available_locales')));
        });

        view()->composer([
            'panels.admin-panel.admin-panel',
            'panels.manager-panel.manager-panel',
            'panels.teacher-panel.teacher-panel',
            'panels.agent-panel.agent-panel',
            'panels.user-panel.user-panel'
            ], function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', collect(config('app.available_locales')));
        });
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
