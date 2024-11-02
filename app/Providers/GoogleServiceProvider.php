<?php

namespace App\Providers;

use Laravel\Socialite\Two\GoogleProvider;
use GuzzleHttp\Client;
use Laravel\Socialite\Facades\Socialite;

class GoogleServiceProvider extends GoogleProvider
{
    protected function getDefaultHttpClient()
    {
        return new Client([
            'verify' => 'D:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\extras\ssl\cacert.pem',
        ]);

    }
}
