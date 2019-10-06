<?php

namespace App\Http\Controllers;

use App\Services\Sms\Notification;
use App\Smslog;
use Illuminate\Http\Request;
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
        $notification = new Notification();
        return $notification->notify($type, $request->restaurant, $request->time ?? null, $request->to);
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
