<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;

class HashHelper
{
    public static function hashBase64($txt)
    {
        $hashedString = Hash::make($txt);
        $base64EncodedHash = base64_encode($hashedString);
        return $base64EncodedHash;
    }

    public static function decodeBase64($base64, $original)
    {
        $decodedHash = base64_decode($base64);
        $isMatch = Hash::check($original, $decodedHash);
        return $isMatch;
    }


}
