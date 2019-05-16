<?php
/**
 * @author: Verem
 * Date: 16/05/2019
 * Time: 7:27 PM
 */

namespace App\Utils;


use Illuminate\Support\Facades\Hash;

class TokenUtils
{
    public static function makeUrl(string $email)
    {
        $token =  Hash::make($email);

        return '/subscriptions/confirm?token=' . $token .'&email=' . $email;
    }

    public static function validateToken(string $token, string $email)
    {
        if (Hash::check($email, $token)) {
            return $email;
        }

        return null;
    }

}
