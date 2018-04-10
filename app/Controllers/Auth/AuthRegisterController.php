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
use Base\Validation\Forms\Auth\AuthForm;
use Base\Models\User\User;
use Base\Models\User\UserPermission;

class AuthRegisterController extends BaseConstructor {
	
	public function getRegister(Request $request, Response $response) {
        return $this->view->render($response, 'auth/register.php');
    }
	
    public function postRegister(Request $request, Response $response) {
		$validation = $this->validator->validate($request, AuthForm::registerRules());

		if($validation->fails()) {
			$this->flash->addMessage('error', $this->config->get('messages.register.error'));
			return $response->withRedirect($this->router->pathFor('getRegister'));
		}
		
		$identifier = $this->hash->hashed($this->config->get('auth.register'));
		
		$user = User::create([
			'username' => mt_rand(100000, 999999),
			'email_address' => $request->getParam('email_address'),
			'first_name' => ucwords(strtolower($request->getParam('first_name'))),
			'last_name' => ucwords(strtolower($request->getParam('last_name'))),
			'mobile_number' => $request->getParam('mobile_number'),
			'password' => $this->hash->password($request->getParam('password')),
			'active' => false,
			'locked' => true,
			'active_hash' => $identifier
		]);

		$user->permissions()->create(UserPermission::$user);
		
		/*
		Send Email to New Registered User
		*/
		$to = $request->getParam('email_address');
		$subject = $this->config->get('company.name') . ' - Account Activation';
		$body = $this->view->fetch('includes/services/emails/activation.php', compact('user', 'identifier'));
		$this->mail->sendEmailWithApi($to, $subject, $body);
		
		/*
		Send SMS to New Registered User
		*/
		/*
		$number = $request->getParam('mobile_number');
		$body = $this->view->fetch('includes/services/sms/activation.php', compact('user', 'identifier'));
		$this->sms->sendSmsWithApi($number, $body);
		*/
		
		unset($_SESSION['old']);

		$this->flash->addMessage('success', $this->config->get('messages.register.success'));
		return $response->withRedirect($this->router->pathFor('getLogin'));
    }

}
