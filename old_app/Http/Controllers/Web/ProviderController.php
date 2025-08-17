<?php

namespace App\Http\Controllers\Web;

use App\Enums\ProviderEnum;
use App\Events\RegistrationEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\UpdateRegisteredUserByProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->scopes(['openid'])->redirect();
    }

    /**
     * @param $provider
     *
     * @return Application|RedirectResponse|Redirector|null
     */
    public function callback($provider)
    {
        $socialiteUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'email'    => $socialiteUser->user['email'],
        ], [
            'fname'             => $provider === "google" ? $socialiteUser->user['given_name'] : explode(" ", $socialiteUser->user['name'])[0],
            'lname'             => $provider === "google" ? $socialiteUser->user['family_name'] : explode(" ", $socialiteUser->user['name'])[1],
            'provider'          => $provider === "google" ? ProviderEnum::google : ProviderEnum::facebook,
            'remember_token'    => $socialiteUser->token,
            'email_verified_at' => Carbon::now(),
        ]);

        Auth::login($user);

        return redirect("/login");
    }

    /**
     * Show Register Role page for users without role
     *
     * @return View
     */
    public function registerRole () {
        return view("auth.register-by-provider")->with("user", auth()->user());
    }

    /**
     * Update role for the user without role
     *
     * @param User                           $user
     * @param UpdateRegisteredUserByProvider $validate
     *
     * @return RedirectResponse
     */
    public function update(User $user,UpdateRegisteredUserByProvider $validate) {

        auth()->user()->update($validate->validated());
        auth()->user()->attachRole($validate->validated(["role"]));
        RegistrationEvent::dispatch(auth()->user());
        return redirect()->route("login");
    }
}
