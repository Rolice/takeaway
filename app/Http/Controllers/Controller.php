<?php

namespace App\Http\Controllers;

use App\Services\Sms\Twilio;
use App\Smslog;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        $this->send('+359897981948', 'ibre');
        $smsLog = Smslog::all();
        return $smsLog->toArray();
    }

    public function send($to, $body)
    {
        $twilio = app(Twilio::class);
        $params = [
            'to' => $to,
            'body' => $body
        ];
        $twilio->setMessageParams($params);
        $message = $twilio->sendMessage();
        if(isset($message['error'])) {
            return json_encode($message);
        }
        else{
            Smslog::create($message);
            return json_encode($message);
        }
    }
}
