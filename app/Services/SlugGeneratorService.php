<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SlugGeneratorService
{
    /**
     * Url Encoding
     * @param $string
     * @return string
     */
    public static function urlEncoder($string)
    {
       return urlencode(preg_replace('/[^A-Za-z0-9\p{L}\-]/u', '-', strtolower(trim($string))));
    }

}
