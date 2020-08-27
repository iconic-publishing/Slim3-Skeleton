<?php

namespace Base\Controllers\Admin;

use Base\Models\User\User;
use Base\Constructor\BaseConstructor;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AdminController extends BaseConstructor {
	
    public function admin(ServerRequestInterface $request, ResponseInterface $response) {
        $user = $this->user();

        return $this->view->render($response, 'admin/index.php', compact('user'));
    }

    protected function user() {
        return User::where('id', $this->auth->user()->id)->first();
    }
	
}

