<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '598254003704583',
        'client_secret' => '74e5b73ed1d3124fef142f1b45523c29',
        'redirect' =>env('FACEBOOK_CALLBACK'),
    ],
    'google'=>[
        'client_id'=>'464156401089-m1b02ns537onfhs10ck65b25ajtj7qfh.apps.googleusercontent.com',
        'client_secret'=>'qOjZ-FVrcbe1hEoC0NZPXtzr',
        'redirect'=>env('GOOGLE_CALLBACK')
    ]

];
