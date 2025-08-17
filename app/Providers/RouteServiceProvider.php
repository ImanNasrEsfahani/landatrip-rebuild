<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/login';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
     protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->mapUserPanelRoutes();
        $this->mapTeacherPanelRoutes();
        $this->mapAdminPanelRoutes();
        $this->mapAgentPanelRoutes();
        $this->mapManagerPanelRoutes();
        $this->mapAppRoutes();
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));
    }

    protected function mapUserPanelRoutes(): void
    {
        Route::prefix('api/web/v1/user-panel')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/web/v1/user-panel/api.php'));
    }

    protected function mapAgentPanelRoutes(): void
    {
        Route::prefix('api/web/v1/agent-panel')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/web/v1/agent-panel/api.php'));
    }


    protected function mapTeacherPanelRoutes(): void
    {
        Route::prefix('api/web/v1/teacher-panel')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/web/v1/teacher-panel/api.php'));
    }

    protected function mapAdminPanelRoutes(): void
    {
        Route::prefix('api/web/v1/admin-panel')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/web/v1/admin-panel/api.php'));
    }

    protected function mapManagerPanelRoutes(): void
    {
        Route::prefix('api/web/v1/manager-panel')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/web/v1/manager-panel/api.php'));
    }

    protected function mapAppRoutes(): void
    {
        Route::prefix('api/app/v1')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/app/v1/api.php'));
    }

    public function redirectTo()
    {
        if (Auth::check()) {
            if (!Auth::user()->email_verified_at) {
                return Redirect::route('verification.notice');
            }
            return route('login');
        }
    }
}
