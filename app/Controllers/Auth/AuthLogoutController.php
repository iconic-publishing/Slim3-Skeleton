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
    Helpers\Cookie
};
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class AuthLogoutController extends BaseConstructor {
	
		public function logout(Request $request, Response $response) {
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
