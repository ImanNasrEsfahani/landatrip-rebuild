<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;

class TestController extends Controller
{
    public function index ()
    {
        $user = User::first();
//        Mail::to($user->email)->send(new VerifyUserEmailMail2($user));
        dd($user);
    }
}
