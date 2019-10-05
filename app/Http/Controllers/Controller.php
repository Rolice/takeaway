<?php

namespace App\Http\Controllers;

use App\Services\Sms\Twilio;
use App\Smslog;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        $smsLog = Smslog::all();
        return view('index', ['smsLog' => $smsLog->toArray()]);
    }

    public function send(Request $request)
    {
        $twilio = app(Twilio::class);
        $params = [
            'to' => $request->to,
            'body' => $request->body
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
