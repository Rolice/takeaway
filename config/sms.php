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
        'callBack' => 'https://ivailotakeaway.localtunnel.me/'
    ],
    'notifications' => [
        'shipped' => 'Your order from %1$s is on its way! It should arrive at %2$s.',
        'review' => 'We hope you enjoyed the food from %1$s. You\'ll receive a free delivery for your next order if you leave a review at http://takeaway.com/review/%1$s !',
    ],
    'notification_service' => 'Twilio',
];
