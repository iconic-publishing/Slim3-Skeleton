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

namespace Base\Controllers;

use Base\Constructor\BaseConstructor;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};
use Base\Models\Press;

class PressController extends BaseConstructor {
	
	public function getPress(Request $request, Response $response) {
		$press = Press::orderBy('published_on', 'DESC')->paginate($this->config->get('paginator.press'))->appends($request->getParams());
		$sideBar = $this->sideBar();
		
        return $this->view->render($response, 'press/press.php', compact('press', 'sideBar'));
    }
	
	public function getPressDetails(Request $request, Response $response, $args) {
		$slug = $args['slug'];
		$press = Press::where('slug', $slug)->first();
		$sideBar = $this->sideBar();
		
        return $this->view->render($response, 'press/press-details.php', compact('press', 'sideBar'));
    }
	
	protected function sideBar() {
		return Press::inRandomOrder()->limit(getenv('SIDE_BAR_LIMIT'))->get();
	}
	
}
