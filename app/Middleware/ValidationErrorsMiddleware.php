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
	Helpers\Session
};
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class ValidationErrorsMiddleware extends BaseConstructor {

    public function __invoke(Request $request, Response $response, Callable $next) {
		Session::exists('errors') ? $this->view->getEnvironment()->addGlobal('errors', Session::get('errors')) : null;
     	Session::delete('errors');

        $response = $next($request, $response);
		
        return $response;
    }
	
}
