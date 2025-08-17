<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Responses\LoginResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        Fortify::registerView(function() {
            return view('auth.register');
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

//        $this->app->instance(LoginResponse::class, new class extends LoginResponse {
//            public function toResponse ($request)
//            {
//                return match (auth()->user()->roles()->first()->name) {
//                    "manager" => redirect(route("manager-panel")),
//                    "admin" => redirect(route("admin-panel")),
//                    "agent" => redirect(route("agent-panel")),
//                    "teacher" => redirect(route("teacher-panel")),
//                    default => redirect(route("user-panel")),
//                };
//            }
//        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string)$request->email;
            return Limit::perMinute(7)->by($email . $request->ip());
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function ($request){
            return view('auth.reset')->with('request', $request);
        });

    }
}
