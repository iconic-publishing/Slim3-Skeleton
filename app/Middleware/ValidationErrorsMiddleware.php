<?php

namespace Base\Middleware;

use Base\Helpers\Session;
use Base\Constructor\BaseConstructor;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ValidationErrorsMiddleware extends BaseConstructor {

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Callable $next) {
        Session::exists('errors') ? $this->view->getEnvironment()->addGlobal('errors', Session::get('errors')) : null;
     	Session::delete('errors');

        return $next($request, $response);
    }
	
}
