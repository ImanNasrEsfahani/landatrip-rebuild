<?php

namespace App\Http\Controllers\Application;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class LoginController extends AuthenticatedSessionController
{

    public function login(LoginRequest $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $expiresAt = Carbon::now()->addDay(config("app.EXPIRATION_DAY"));
        $token = $user->createToken('auth-token', ['read', 'write'], $expiresAt)->plainTextToken;

        return response()->json(['token' => $token]);

    }


    public function logout(Request $request)
    {
        PersonalAccessToken::where("token", "=", $request->user()->currentAccessToken()->token)
            ->update(['expires_at' => Carbon::now()->subDay(1)]);
        return response()->json("goodbye", 200);
    }
}
