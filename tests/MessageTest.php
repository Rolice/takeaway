<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class MessageTest extends TestCase
{
    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertResponseStatus(200);
    }

    public function testShippedMessage()
    {
        $to = '+359897981948';
        $restaurant = 'Restaurant 3';
        $time = '12:35';
        $response = $this->json('POST', '/notify/shipped', ['to' => $to, 'restaurant' => $restaurant, 'time' => $time]);
        $actualResponse = $response->response->content();

        //first check if we have http 200
        $response->assertResponseStatus('200');

        //then check if we get the proper status, should be "queued" initially.
        $response->seeJson(['to' => $to, 'status' => 'queued']);

        //get the message sid from the twilio response and check if it's present in the smslogs table
        $sid = json_decode($actualResponse)->sid;
        $this->seeInDatabase('smslogs', ['to' => $to, 'sid' => $sid]);
    }
}
