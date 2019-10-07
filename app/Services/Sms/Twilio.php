<?php


namespace App\Services\Sms;
use App\Smslog;
use Twilio\Exceptions\HttpException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class Twilio
{
    /**
     * The number to send the message to
     * @var string
     */
    public $to;

    /**
     * The body of the message
     * @var string
     */
    public $body;

    /**
     * The number which sends the message
     * @var string
     */
    private $from;

    /**
     * Twilio hostname
     * @var string
     */
    private $host;

    /**
     * Twilio SID
     * @var string
     */
    private $sid;

    /**
     * Twilio auth token
     * @var string
     */
    private $token;

    /**
     * Twilio constructor. Populates the object from config.
     * @param $host
     * @param $sid
     * @param $token
     * @param $from
     */
    public function __construct($host, $sid, $token, $from)
    {
        $this->host = $host;
        $this->sid = $sid;
        $this->token = $token;
        $this->from = $from;
    }

    /**
     * sends the actual message
     * @return array
     * @throws TwilioException
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function sendMessage()
    {
        $this->host .= '/Accounts/'.$this->sid.'/Messages';

        $client = new Client($this->sid, $this->token);
        $params = [
            'from' => $this->from,
            'body' => $this->body,
            'statusCallback' => config('sms.twilio.callBack').'status',
        ];
        $message = $client->messages->create($this->to, $params);
        $return = [
            'from' => $message->from,
            'to' => $message->to,
            'body' => $message->body,
            'status' => $message->status,
            'sid' => $message->sid
        ];
        return $return;
    }

    /**
     * Populates the message params - to and body.
     * @param $params
     */
    public function setMessageParams($params)
    {
        $this->to = $params['to'];
        $this->body = $params['body'];
    }
}
