<?php

namespace Base\Controllers\Auth;

use Base\Helpers\Cookie;
use Base\Constructor\BaseConstructor;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthLogoutController extends BaseConstructor {
	
    public function logout(ServerRequestInterface $request, ResponseInterface $response) {
        if(Cookie::exists($this->config->get('auth.remember'))) {
            $this->auth->user()->removeRememberCredentials();
            Cookie::delete($this->config->get('auth.remember'), null, 1);
        }

        $this->auth->user()->removeLoginToken();
        $this->auth->logout();

        $this->flash->addMessage('warning', $this->config->get('messages.login.logout'));
        return $response->withRedirect($this->router->pathFor('getLogin'));
    }
	
}
