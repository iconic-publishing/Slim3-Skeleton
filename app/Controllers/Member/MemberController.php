<?php

namespace Base\Controllers\Member;

use Base\Models\User\User;
use Base\Constructor\BaseConstructor;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MemberController extends BaseConstructor {
	
    public function member(ServerRequestInterface $request, ResponseInterface $response) {
        $user = $this->user();

        return $this->view->render($response, 'member/index.php', compact('user'));
    }

    protected function user() {
        return User::where('id', $this->auth->user()->id)->first();
    }
	
}
