<?php

namespace App\Helpers;

use App\Models\Password\PasswordResetToken;
use Illuminate\Support\Str;

class CodeVerifyHelper
{
    /**
     * @return string
     * @throws \Exception
     */
    public static function generateCode()
    {
        // do {
        $code = rand(1000, 9999);
        // } while (PasswordResetToken::where('token', $code)->exists());

        return $code;
    }
}
