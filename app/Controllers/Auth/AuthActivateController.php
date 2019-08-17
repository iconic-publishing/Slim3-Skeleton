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

namespace Base\Controllers\Auth;

use Base\{
    Constructor\BaseConstructor,
    Models\User\User,
    Services\Mail\Verification
};
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class AuthActivateController extends BaseConstructor {
	
    public function activate(Request $request, Response $response) {
        $email_address = $request->getParam('email_address');
        $identifier = $request->getParam('identifier');
        
		$user = User::where('email_address', $email_address)->where('active', false)->first();

        if(!$user) {
            $this->flash->addMessage('info', $this->config->get('messages.activate.active'));
            return $response->withRedirect($this->router->pathFor('getLogin'));
        }

        if(!$user || !$this->hash->hashCheck($user->active_hash, $identifier)) {
            $this->flash->addMessage('error', $this->config->get('messages.activate.problem'));
            return $response->withRedirect($this->router->pathFor('getLogin'));
        } else {
            $user->activateAccount();

            $this->mail->to($user->email_address, $this->config->get('mail.from.name'))->send(new Verification($user));

            /*
            Send SMS to User
            */
            $number = $user->mobile_number;
            $body = $this->view->fetch('includes/services/sms/verification.php', compact('user', 'identifier'));
            $this->sms->send($number, $body);

            $this->flash->addMessage('success', $this->config->get('messages.activate.success'));
            return $response->withRedirect($this->router->pathFor('getLogin'));
        }
    }
	
}


