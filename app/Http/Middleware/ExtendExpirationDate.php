<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class ExtendExpirationDate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request                                                         $request
     * @param \Closure(\Illuminate\Http\Request): (Response|\Illuminate\Http\RedirectResponse) $next
     *
     * @return Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
//        dd($request->route());

        if (in_array("app", explode("/", $request->route()->getPrefix()))) {
            if ($request->expectsJson()) {
                if (Auth::check()) {
                    $expirationTime = now()->addDay(config("app.EXPIRATION_DAY"));
                    PersonalAccessToken::where("token", "=", $request->user()->currentAccessToken()->token)->update(['expires_at' => $expirationTime]);
                }
            }
        }
        return $next($request);
    }
}
