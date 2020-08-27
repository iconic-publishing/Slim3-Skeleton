<?php

namespace Base\Middleware;

use Base\Helpers\Session;
use Base\Constructor\BaseConstructor;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OldInputMiddleware extends BaseConstructor {
	
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Callable $next) {
        Session::exists('old') ? $this->view->getEnvironment()->addGlobal('old', Session::get('old')) : null;
        Session::put('old', $request->getParams());

        return $next($request, $response);
    }
	
}

