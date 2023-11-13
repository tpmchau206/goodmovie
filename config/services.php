<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '1002272130881609',
        'client_secret' => '383465e8a271fc214c799b0838c795d5',
        'redirect' => '/login/facebook/callback',
    ],

    'google' => [
        'client_id' => '537153468479-hr4cmja07vni1q168sln0nphjs3h944n.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => '/login/google/callback',
    ],
];
