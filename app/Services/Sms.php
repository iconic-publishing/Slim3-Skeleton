<?php
/********************************************************************
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ 
@Author			John Hoddy <john.hoddy@iconic-publishing.com>
@Website		https://www.iconic-publishing.com
@Created		Monday, 2nd April, 2018

© Copyright 2014 - 2018 Iconic Publishing Co Ltd. All Rights Reserved
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
Change Request ID: 

~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
*********************************************************************/

namespace Base\Services;

use Base\Constructor\BaseConstructor;
use Twilio\{
    Rest\Client,
    Exceptions\TwilioException
};

class Sms extends BaseConstructor {
	
    public function send($number, $body) {
        $sid = $this->config->get('twilio.sid');
        $token = $this->config->get('twilio.token');

        $client = new Client($sid, $token);

        try {
            $message = $client->messages->create($number, [
                'from' => $this->config->get('twilio.number'),
                'body' => $body
            ]);

            return $message;
        } catch (TwilioException $e) {
            // Catch error if so required
            // return $e->getMessage();
        }
    }
	
}
