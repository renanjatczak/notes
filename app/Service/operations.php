<?php

namespace App\Service;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

Class operations
{
    public static function decryptId($value)
    {
        // Check if the value is encrypted 
        try {
            $value = Crypt::decrypt($value);
        } catch (DecryptException $e) {
            // Handle decryption failure
            return redirect()->route('home');
        }

        return $value;
    }
}
