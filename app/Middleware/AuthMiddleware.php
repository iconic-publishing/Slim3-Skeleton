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

namespace Base\Middleware;

use Base\Constructor\BaseConstructor;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class AuthMiddleware extends BaseConstructor {
	
    public function __invoke(Request $request, Response $response, callable $next) {
        if(!$this->auth->check()) {
            $this->flash->addMessage('warning', $this->config->get('messages.auth.error'));
            return $response->withRedirect($this->router->pathFor('getLogin'));
        }
		
		$token = $request->getAttribute('routeInfo')[2]['token'];
		
        if(!$this->hash->hashCheck($this->auth->user()->token, $token)) {
			$this->auth->user()->removeLoginToken();
			$this->auth->logout();
			$this->flash->addMessage('warning', $this->config->get('messages.auth.info'));
			return $response->withRedirect($this->router->pathFor('getLogin'));
		}

        $response = $next($request, $response);
		
        return $response;
    }
	
}
