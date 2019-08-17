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

use Base\Constructor\BaseConstructor;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class CsrfStatusMiddleware extends BaseConstructor {
	
    public function __invoke(Request $request, Response $response, Callable $next) {
        if($request->getAttribute('csrf_status') === false) {
			$this->flash->addMessage('error', $this->config->get('messages.csrf.error'));
			return $response->withRedirect($_SERVER['HTTP_REFERER']);
		}

        $response = $next($request, $response);
		
        return $response;
    }
	
}
