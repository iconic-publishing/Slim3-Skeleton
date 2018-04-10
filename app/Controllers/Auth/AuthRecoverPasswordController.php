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

class AuthRecoverPasswordController extends BaseConstructor {
	
	public function getRecoverPassword(Request $request, Response $response) {
        return $this->view->render($response, 'auth/recover-password.php');
    }
	
	public function postRecoverPassword(Request $request, Response $response) {
		$validation = $this->validator->validate($request, AuthForm::recoverPasswordRules());

		if($validation->fails()) {
			$this->flash->addMessage('error', $this->config->get('messages.recover.required'));
			return $response->withRedirect($this->router->pathFor('getRecoverPassword'));
		}

		$email_address = $request->getParam('email_address');

		$user = User::where('email_address', $email_address)->first();

		if(!$user) {
			$this->flash->addMessage('error', $this->config->get('messages.recover.error'));
			return $response->withRedirect($this->router->pathFor('getRecoverPassword'));
		} else {
			$identifier = $this->hash->hashed();

			$user->update([
				'recover_hash' => $identifier
			]);
			
			/*
			Send Email to New Registered User
			*/
			$to = $user->email_address;
			$subject = $this->config->get('company.name') . ' - Password Recovery';
			$body = $this->view->fetch('includes/services/emails/recover-password.php', compact('user', 'identifier'));
			$this->mail->sendEmailWithApi($to, $subject, $body);
			
			/*
			Send SMS to New Registered User
			*/
			$number = $user->mobile_number;
			$body = $this->view->fetch('includes/services/sms/recover-password.php', compact('user'));
			$this->sms->sendSmsWithApi($number, $body);
			
			unset($_SESSION['old']);

			$this->flash->addMessage('success', $this->config->get('messages.recover.success'));
			return $response->withRedirect($this->router->pathFor('getLogin'));
		}
	}

}
