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

namespace Base\Controllers\Member;

use Base\{
	Constructor\BaseConstructor,
	Models\User\User
};
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class MemberController extends BaseConstructor {
	
	public function member(Request $request, Response $response) {
		$user = $this->user();
		
		return $this->view->render($response, 'member/index.php', compact('user'));
    }

	protected function user() {
		return User::where('id', $this->auth->user()->id)->first();
	}
	
}
