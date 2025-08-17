<?php

namespace App\Http\Controllers\Web;

use App\Events\MembershipEvent;
use App\Events\ResendVrificationCodeEvent;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use http\Client\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerifyEmailController extends Controller
{
    /**
     * @return array|false|Application|Factory|View|RedirectResponse|mixed
     */
    public function index()
    {
        if (!auth()->user()->email_verified_at){
            return view("auth.verify-email");
        }
        return redirect()->route('login');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'verification_code' => [ 'required', 'numeric']
        ]);

        if ((!auth()->user()->email_verified_at) && (Carbon::now() <= auth()->user()->verification_code_expire)){
            if (auth()->user()->verification_code === $validated['verification_code']){
                auth()->user()->update([
                    'email_verified_at' => Carbon::now()
                ]);
                MembershipEvent::dispatch(auth()->user());
            }
        else
        {
            return response()->json([
                'message'   => 'This verification code has been expired',
                'error'   => 'This verification code has been expired'
            ], 422);
        }

        }
        return redirect()->route('login');
    }

    public function resend()
    {
        auth()->user()->update([
            "verification_code" =>  rand(10, 100 . '2151')
        ]);
        ResendVrificationCodeEvent::dispatch(auth()->user());
    }
}
