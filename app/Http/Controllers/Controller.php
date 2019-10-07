<?php

namespace App\Http\Controllers;

use App\Services\Sms\Notification;
use App\Smslog;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Takes care of the sms log listing
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $smsLog = Smslog::take(50)->orderByRaw("FIELD(status, 'undelivered', 'sent', 'failed', 'queued', 'delivered')")->get();
        return view('index', ['smsLog' => $smsLog->toArray()]);
    }

    /**
     * Used to send notifications via SMS. The $type parameter defines the template to use.
     * @param Request $request
     * @param $type
     * @return false|string
     * @throws \Exception
     */
    public function notify(Request $request, $type)
    {
        $notification = new Notification();
        $time = null;
        if(isset($request->time)){
            $time = $request->time;
        }
        return $notification->notify($type, $request->restaurant, $request->to, $time);
    }

    /**
     * A callback url to update the message status
     * @param Request $request
     */
    public function status(Request $request)
    {
        if(isset($request->MessageSid))
        {
            $message = Smslog::where('sid', $request->MessageSid);
            $message->update(['status' => $request->MessageStatus]);
        }
    }
}
