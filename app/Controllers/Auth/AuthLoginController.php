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
	Helpers\Session,
	Helpers\Cookie
};
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};
use Carbon\Carbon;

class AuthLoginController extends BaseConstructor {

    public function getLogin(Request $request, Response $response) {
        return $this->view->render($response, 'auth/login.php');
    }

    public function postLogin(Request $request, Response $response) {
		$validation = $this->validator->validate($request, AuthForm::loginRules());

		if($validation->fails()) {
			$this->flash->addMessage('error', $this->config->get('messages.login.error'));
			return $response->withRedirect($this->router->pathFor('getLogin'));
		}

		$identifier = $request->getParam('email_or_username');
		$email_address = $request->getParam('email_address');
		$password = $request->getParam('password');
		$remember = $request->getParam('remember');

		$user = User::where(function($query) use ($identifier) {
			return $query->where('email_address', $identifier)->orWhere('username', $identifier);
		})->first();
		
		if(!$user->recover_hash == null) {
			$this->flash->addMessage('warning', $this->config->get('messages.login.passwordReset'));
			return $response->withRedirect($this->router->pathFor('getLogin'));
		}

		if(!$user || !$this->hash->passwordCheck($password, $user->password)) {
			$this->flash->addMessage('error', $this->config->get('messages.login.notUser'));
			return $response->withRedirect($this->router->pathFor('getLogin'));
		}

		if(!$user->active == true) {
			$this->flash->addMessage('warning', $this->config->get('messages.login.notActive'));
			return $response->withRedirect($this->router->pathFor('getLogin'));
		}

		if(!$user->locked == false) {
			$this->flash->addMessage('warning', $this->config->get('messages.login.locked'));
			return $response->withRedirect($this->router->pathFor('getLogin'));
		}

		if($user && $this->hash->passwordCheck($password, $user->password)) {
			Session::put('user', $user->id);

			$size = $this->config->get('auth.token');
			$token = $this->hash->hashed($size);

			$user->createLoginToken($token);

			if($remember === 'on') {
				$rememberIdentifier = $this->hash->hashed($size);
				$rememberToken = $this->hash->hashed($size);

				$user->updateRememberCredentials(
					$rememberIdentifier,
					$rememberToken
				);

				Cookie::put($this->config->get('auth.remember'), 
					$rememberIdentifier . '___' . $rememberToken, 
					Carbon::parse('+1 month')->timestamp
				);
			}

			if($this->auth->user()->isGroup()) {
				return $response->withRedirect($this->router->pathFor('admin', compact('token')));
			} else {
				return $response->withRedirect($this->router->pathFor('member', compact('token')));
			}
		} else {
			$this->flash->addMessage('warning', $this->config->get('messages.login.notActive'));
			return $response->withRedirect($this->router->pathFor('getLogin'));
		}
    }

}

