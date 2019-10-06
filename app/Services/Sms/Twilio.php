<?php


namespace App\Services\Sms;
use App\Smslog;
use Twilio\Exceptions\HttpException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class Twilio
{
    public $to;

    public $body;

    private $from;

    private $host;

    private $sid;

    private $token;

    public function __construct($host, $sid, $token, $from)
    {
        $this->host = $host;
        $this->sid = $sid;
        $this->token = $token;
        $this->from = $from;
    }

    public function sendMessage()
    {
        $this->host .= '/Accounts/'.$this->sid.'/Messages';

        $client = new Client($this->sid, $this->token);
        $params = [
            'from' => $this->from,
            'body' => $this->body,
            'statusCallback' => config('sms.twilio.callBack').'/',
        ];
        $message = $client->messages->create($this->to, $params);
        $return = [
            'from' => $message->from,
            'to' => $message->to,
            'body' => $message->body,
            'status' => $message->status
        ];
        return $return;
    }

    public function setMessageParams($params)
    {
        $this->to = $params['to'];
        $this->body = $params['body'];
    }
}
