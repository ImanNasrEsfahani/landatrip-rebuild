<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;
use Symfony\Component\Console\Input\Input;

class PusherController extends Controller
{
    public function pusherAuth()
    {
        $user = auth()->user();
        if ($user) {
            $pusher = new Pusher('auth-key', 'secret', 'app_id');
            $auth= $pusher->socket_auth(Input::get('channel_name'), Input::get('socket_id'));
            $callback = str_replace('\\\\', '', $_GET['callback']);
            header('Content-Type: application/javascript');
            echo($callback . '(' . $auth . ');');
            return;
        } else {
            header('', true, 403);
            echo "Forbidden";
            return;
        }
    }
}
