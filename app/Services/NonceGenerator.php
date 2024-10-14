<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class NonceGenerator
{
    public static function generate()
    {
        $nonce = Str::random(32);
        Session::put('nonce', $nonce);
        return $nonce;
    }

    public static function verify($nonce)
    {
        $valid = $nonce === Session::get('nonce');
        Session::forget('nonce');
        return $valid;
    }
}
