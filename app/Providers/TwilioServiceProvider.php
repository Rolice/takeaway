<?php

namespace App\Providers;

use App\Services\Sms\Twilio;
use Illuminate\Support\ServiceProvider;

class TwilioServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Twilio::class, function (){
            return new Twilio(config('sms.twilio.host'), config('sms.twilio.sid'), config('sms.twilio.token'), config('sms.twilio.from'));
        });
    }
}
