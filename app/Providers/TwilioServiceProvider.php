<?php

namespace App\Providers;

use App\Services\Sms\Twilio;
use Illuminate\Support\ServiceProvider;

class TwilioServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Twilio::class, function (){
            $host = config('sms.twilio.host');
            $sid = config('sms.twilio.sid');
            $token = config('sms.twilio.token');
            $from = config('sms.twilio.from');
            return new Twilio($host, $sid, $token, $from);
        });
    }
}
