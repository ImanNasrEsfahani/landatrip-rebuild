<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use function config;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * ReCaptcha checker method
     *
     * @param $request
     * @return boolean
     */
    public function recaptcha($request): bool
    {
        if(strtolower(env('APP_ENV', 'dev')) !== "prod") return true;
        if(strtolower(env('APP_ENV', 'dev')) !== "production") return true;

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteIP = $_SERVER['REMOTE_ADDR'];
        $data = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->get('recaptcha'),
            'remoteip' => $remoteIP
        ];
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);

        if ($resultJson->success !== true) {
            return false;
        }
        if ($resultJson->score >= 0.6) {
            return true;
        }
        return false;
    }
}
