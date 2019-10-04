<?php


namespace App\Services\Sms;
use App\Smslog;
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
        try {
            $client = new Client($this->sid, $this->token);
            $message = $client->messages->create($this->to, ['from' => $this->from, 'body' => $this->body]);
            $this->logMessage($message->status);
            return true;
        }
        catch (TwilioException $e){
            return false;
        }
    }

    public function setMessageParams($params)
    {
        $this->to = $params['to'];
        $this->body = $params['body'];
    }

    public function logMessage($status)
    {
        Smslog::create(['to' => $this->to, 'from' => $this->from, 'body' => $this->body, 'status' => $status]);
    }
}
