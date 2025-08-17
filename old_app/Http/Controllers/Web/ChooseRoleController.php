<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChooseRoleController extends Controller
{
    public function index()
    {
        if(!auth()->user()->roles()->first()){
            return view('auth.choose-role');
        }
        return redirect()->route('login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role'  =>  ['required', 'in:user,teacher']
        ]);

        if(!auth()->user()->roles()->first()){
            auth()->user()->addRole($validated['role']);

        }
        return redirect()->route('login');
    }
}
