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

class Mailchimp extends BaseConstructor {
	
	public function subscribeCustomer($email, $firstname) {
		$apikey = $this->api();
		$auth 	= base64_encode('user:' . $apikey);
													
		$data = [
			'apikey'        => $apikey,
			'email_address' => $email,
			'status'        => 'subscribed',
			'merge_fields'  => [
				'FNAME' => $firstname
			]
		];
		
		$json = json_encode($data);
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $this->config->get('mailchimp.list.customer'));
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json', 
			'Authorization: Basic ' . $auth
		]);
		curl_setopt($curl, CURLOPT_USERAGENT, 'PHP-MCAPI/3.0');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $json); 
		
		return curl_exec($curl);
	}
	
	protected function api() {
		return $this->config->get('mailchimp.api');
	}
	
}