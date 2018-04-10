<?php
/********************************************************************
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ 
@Author			John Hoddy <john.hoddy@iconic-publishing.com>
@Website		https://www.iconic-publishing.com
@Created		Monday, 12th March, 2018

© Copyright 2014 - 2018 Iconic Publishing Co Ltd. All Rights Reserved
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
Change Request ID: 

~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
*********************************************************************/

namespace Base\Plugins;

use Base\Constructor\BaseConstructor;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;

class Sms extends BaseConstructor {
	
	public function sendSmsWithApi($number, $body) {
		$sid = $this->config->get('twilio.sid');
		$token = $this->config->get('twilio.token');

		$client = new Client($sid, $token);
		
		try {
			$message = $client->messages->create($number, [
				'from' => $this->config->get('twilio.number'),
				'body' => $body
			  ]
			);

			return $message;
		} catch (TwilioException $e) {
			//Catch error if so required
        }
	}
	
}
