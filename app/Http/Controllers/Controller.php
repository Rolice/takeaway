<?php

namespace App\Http\Controllers;

use App\Services\Sms\Twilio;
use App\Smslog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        $smsLog = Smslog::take(50)->orderByRaw("FIELD(status, 'undelivered', 'sent', 'failed', 'queued', 'delivered')")->get();
        return view('index', ['smsLog' => $smsLog->toArray()]);
    }

    public function notify(Request $request, $type)
    {
        $body = config('sms.notifications.'.$type);
        if($body == null){
            $message['error'] = 'No such message template.';
            return json_encode($message);
        }

        $body = sprintf($body, $request->restaurant, $request->time);
        $twilio = app(Twilio::class);
        $params = [
            'to' => $request->to,
            'body' => $body
        ];
        $twilio->setMessageParams($params);
        $message = $twilio->sendMessage();

        Smslog::create($message);
        return json_encode($message);
    }

    public function status(Request $request)
    {
        if($request->MessageSid)
        {
            $message = Smslog::where('sid', $request->MessageSid);
            $message->update(['status' => $request->MessageStatus]);
        }
    }
}
