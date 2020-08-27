<?php

namespace Base\Controllers;

use Base\Constructor\BaseConstructor;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class StaticSiteController extends BaseConstructor {
	
    public function index(ServerRequestInterface $request, ResponseInterface $response) {
        return $this->view->render($response, 'index.php');
    }
	
}
