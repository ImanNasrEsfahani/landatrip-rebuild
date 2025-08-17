<?php

namespace App\Http\Controllers\Api\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminInfoResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userInfo()
    {
        return new AdminInfoResource(auth()->user());
    }}
