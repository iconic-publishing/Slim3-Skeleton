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
    Validation\Forms\Auth\AuthForm,
    Models\User\User,
    Services\Mail\Recover,
    Helpers\Session
};
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class AuthRecoverPasswordController extends BaseConstructor {
	
    public function getRecoverPassword(Request $request, Response $response) {
        return $this->view->render($response, 'auth/recover-password.php');
    }
	
    public function postRecoverPassword(Request $request, Response $response) {
        $validation = $this->validator->validate($request, AuthForm::recoverPasswordRules());

        if($validation->fails()) {
            $this->flash->addMessage('error', $this->config->get('messages.recover.required'));
            return $response->withRedirect($this->router->pathFor('getRecoverPassword'));
        }

        $email_address = $request->getParam('email_address');

        $user = User::where('email_address', $email_address)->first();

        if(!$user) {
            $this->flash->addMessage('error', $this->config->get('messages.recover.error'));
            return $response->withRedirect($this->router->pathFor('getRecoverPassword'));
        } else {
            $identifier = $this->hash->hashed($this->config->get('auth.recover'));

            $user->update([
                'recover_hash' => $identifier
            ]);

            $this->mail->to($user->email_address, $this->config->get('mail.from.name'))->send(new Recover($user, $identifier));

            /*
            Send SMS to User
            */
            $number = $user->mobile_number;
            $body = $this->view->fetch('includes/services/sms/recover-password.php', compact('user'));
            $this->sms->send($number, $body);

            Session::delete('old');

            $this->flash->addMessage('success', $this->config->get('messages.recover.success'));
            return $response->withRedirect($this->router->pathFor('getLogin'));
        }
    }

}
