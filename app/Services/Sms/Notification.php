<?php


namespace App\Services\Sms;


use App\Smslog;

class Notification
{
    /**
     * A method to send a notification. Populates the message template then calls the appropriate service.
     * @param $type
     * @param $restaurant
     * @param $to
     * @param null $time
     * @return false|string
     * @throws \Exception
     */
    public function notify($type, $restaurant, $to, $time = null)
    {
        $body = config('sms.notifications.'.$type);
        if($body == null){
            throw new \Exception('[HTTP 400] No such message template.');
        }

        if($time) {
            $body = sprintf($body, $restaurant, $time);
        }
        else{
            $body = sprintf($body, urlencode($restaurant), $time);
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
