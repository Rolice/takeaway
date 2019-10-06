<?php


namespace App\Services\Sms;


use App\Smslog;

class Notification
{
    public function notify($type, $restaurant, $time = null, $to)
    {
        $body = config('sms.notifications.'.$type);
        if($body == null){
            throw new \Exception('[HTTP 400] No such message template.');
        }

        if($time) {
            $body = sprintf($body, $restaurant, $time);
        }
        else{
            $body = sprintf($body, urlencode($restaurant));
        }
        $notificationService = 'App\Services\Sms\\'.config('sms.notification_service');
        $twilio = app($notificationService);
        $params = [
            'to' => $to,
            'body' => $body
        ];
        $twilio->setMessageParams($params);
        $message = $twilio->sendMessage();

        Smslog::create($message);
        return json_encode($message);
    }
}
