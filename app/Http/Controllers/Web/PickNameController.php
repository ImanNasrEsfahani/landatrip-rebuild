<?php

namespace App\Http\Controllers\Web;

use App\Enums\ProviderEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PickNameController extends Controller
{
    public function index()
    {
        if (!(auth()->user()->provider === ProviderEnum::landatrip) &&  !(auth()->user()->roles()->first())){
            return view('auth.pick-name');
        }
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname'    => ['required', 'string', 'max:255', 'min:3'],
            'lname'    => ['required', 'string', 'max:255', 'min:3'],
        ]);

        auth()->user()->update($validated);

        return redirect()->route("choose-role");
    }
}
