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

namespace Base\Middleware;

use Base\{
    Constructor\BaseConstructor,
    Helpers\Cookie
};
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class AuthMiddleware extends BaseConstructor {
	
    public function __invoke(Request $request, Response $response, Callable $next) {
        if(!$this->auth->check()) {
            $this->flash->addMessage('warning', $this->config->get('messages.auth.error'));
            return $response->withRedirect($this->router->pathFor('getLogin'));
        }

        $token = $request->getAttribute('routeInfo')[2]['token'];

        if(!$this->hash->hashCheck($this->auth->user()->token, $token)) {
            if(Cookie::exists($this->config->get('auth.remember'))) {
                $this->auth->user()->removeRememberCredentials();
                Cookie::delete($this->config->get('auth.remember'), null, 1);
            }

            $this->auth->user()->removeLoginToken();
            $this->auth->user()->removeLoginIp();
            $this->auth->logout();

            $this->flash->addMessage('warning', $this->config->get('messages.auth.info'));
            return $response->withRedirect($this->router->pathFor('getLogin'));
        }

        return $next($request, $response);
    }
	
}
