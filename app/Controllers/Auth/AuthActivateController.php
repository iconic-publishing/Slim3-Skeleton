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

namespace Base\Controllers\Auth;

use Base\Constructor\BaseConstructor;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};
use Base\Models\User\User;

class AuthActivateController extends BaseConstructor {
	
    public function activate(Request $request, Response $response) {
		$email_address = $request->getParam('email_address');
		$identifier = $request->getParam('identifier');
	    
		//$active = User::where('email_address', $email_address)->where('active', true)->first();
		$user = User::where('email_address', $email_address)->where('active', false)->first();
		
		if(!$user) {
			$this->flash->addMessage('info', $this->config->get('messages.activate.active'));
			return $response->withRedirect($this->router->pathFor('getLogin'));
		}
		
		//$user = User::where('email_address', $email_address)->where('active', false)->first();
	
		if(!$user || !$this->hash->hashCheck($user->active_hash, $identifier)) {
			$this->flash->addMessage('error', $this->config->get('messages.activate.problem'));
			return $response->withRedirect($this->router->pathFor('getLogin'));
		} else {
			$user->activateAccount();
			
			/*
			Send Email to New Registered User
			*/
			$to = $user->email_address;
			$subject = $this->config->get('company.name') . ' - Account Verification';
			$body = $this->view->fetch('includes/services/emails/verification.php', compact('user'));
			$this->mail->sendEmailWithApi($to, $subject, $body);
			
			/*
			Send SMS to New Registered User
			/
			$number = $user->mobile_number;
			$body = $this->view->fetch('includes/services/sms/verification.php', compact('user', 'identifier'));
			$this->sms->sendSmsWithApi($number, $body);
			*/
			
			$this->flash->addMessage('success', $this->config->get('messages.activate.success'));
			return $response->withRedirect($this->router->pathFor('getLogin'));
		}
    }
	
}


