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

namespace Base\ErrorHandlers;

use Base\Constructor\BaseConstructor;
use Slim\Handlers\AbstractHandler;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};
use Exception;

class ErrorHandler extends BaseConstructor {
	
	public function __invoke(Request $request, Response $response, Exception $exception) {
		return $this->view->render($response, 'includes/errors/500.php')->withStatus(500)->withHeader('Content-Type', 'text/html');
	}
	
}
