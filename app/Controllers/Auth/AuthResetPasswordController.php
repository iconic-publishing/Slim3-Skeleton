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

namespace Base\Controllers\Auth;

use Base\{
	Constructor\BaseConstructor,
	Validation\Forms\Auth\AuthForm,
	Models\User\User,
	Services\Mail\Reset,
	Helpers\Session
};
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class AuthResetPasswordController extends BaseConstructor {
	
	public function getResetPassword(Request $request, Response $response, $args) {
		$email = $args['email_address'];
		$user = User::where('email_address', $email)->first();
		
		if($user->recover_hash == null) {
			return $response->withRedirect($this->router->pathFor('getLogin'));
		}
		
        return $this->view->render($response, 'auth/reset-password.php', compact('user'));
    }
	
	public function postResetPassword(Request $request, Response $response, $args) {
		$email_address = $args['email_address'];

		$validation = $this->validator->validate($request, AuthForm::resetPasswordRules());

		if($validation->fails()) {
			$this->flash->addMessage('error', $this->config->get('messages.reset.required'));
			return $response->withRedirect($this->router->pathFor('getResetPassword', compact('email_address')));
		}

		$user = User::where('email_address', $email_address)->first();

		$identifier = $user->recover_hash;
		$password = $request->getParam('password');

		if(!$user || !$this->hash->hashCheck($user->recover_hash, $identifier)) {
			$this->flash->addMessage('error', $this->config->get('messages.reset.error'));
			return $response->withRedirect($this->router->pathFor('getResetPassword', compact('email_address')));
		} else {
			$user->update([
				'password' => $this->hash->password($password),
				'recover_hash' => null
			]);
			
			$this->mail->to($user->email_address, $this->config->get('mail.from.name'))->send(new Reset($user));
			
			/*
			Send SMS to User
			*/
			$number = $user->mobile_number;
			$body = $this->view->fetch('includes/services/sms/reset-password.php', compact('user'));
			$this->sms->send($number, $body);

			Session::delete('old');

			$this->flash->addMessage('success', $this->config->get('messages.reset.success'));
			return $response->withRedirect($this->router->pathFor('getLogin'));
		}
	}

}
