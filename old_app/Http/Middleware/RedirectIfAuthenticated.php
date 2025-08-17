<?php

namespace App\Http\Middleware;

use App\Enums\ProviderEnum;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param string|null ...$guards
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (!(auth()->user()->provider->value === ProviderEnum::landatrip) &&  !(auth()->user()->roles()->first())){
                    return redirect()->route("pick-name");
                }

                if(!auth()->user()->roles()->first()) {
                    return redirect()->route("choose-role");
                }

                if (!auth()->user()->email_verified_at){
                    return redirect()->route("verify-email.index");
                }
                return redirect(
                    match (auth()->user()->roles()->first()->name) {
                        "manager"   => route("manager-panel"),
                        "admin"     => route("admin-panel"),
                        "teacher"   => route("teacher-panel"),
                        "agent"     => route("agent-panel"),
                        default     => route("user-panel")
                    });
            }
        }

        return $next($request);
    }
}
