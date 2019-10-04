<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Services used for SMS messages
    |--------------------------------------------------------------------------
    |
    */
    'twilio' => [
        'host' => env('TWILIO_HOST', 'https://api.twilio.com/2010-04-01'),
        'sid' => env('TWILIO_SID'),
        'token' => env('TWILIO_TOKEN'),
        'from' => env('TWILIO_FROM'),
    ],
];
