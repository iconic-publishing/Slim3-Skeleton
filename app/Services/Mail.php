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
use Http\Adapter\Guzzle6\Client;
use Mailgun\Mailgun;

class Mail extends BaseConstructor {

	public function sendEmailWithApi($to, $subject, $body) {
        $client	= new Client();
		$mailgun = new Mailgun($this->config->get('mailgun.api'), $client);
		$domain = $this->config->get('mailgun.domain');
	
		$builder = $mailgun->MessageBuilder();
		$builder->setFromAddress($this->config->get('mailgun.from'));
		$builder->addToRecipient($to);
		$builder->setSubject($subject);
		$builder->setTextBody($body);
		
		return $mailgun->post("{$domain}/messages", $builder->getMessage());
    }
	
}
