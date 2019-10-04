<?php

namespace App\Http\Controllers;

use App\Services\Sms\Twilio;
use App\Smslog;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        $this->send();
        $smsLog = Smslog::all();
        dd($smsLog->toArray());
    }

    public function send()
    {
        $twilio = app(Twilio::class);
        $params = [
            'to' => "+359897981948",
            'body' => "test"
        ];
        $twilio->setMessageParams($params);
        $twilio->sendMessage();
    }
}
