<?php

namespace Base\Controllers\Auth;

use Base\Helpers\Session;
use Base\Models\User\User;
use Base\Services\Mail\Recover;
use Base\Constructor\BaseConstructor;
use Psr\Http\Message\ResponseInterface;
use Base\Validation\Forms\Auth\AuthForm;
use Psr\Http\Message\ServerRequestInterface;

class AuthRecoverPasswordController extends BaseConstructor {
	
    public function getRecoverPassword(ServerRequestInterface $request, ResponseInterface $response) {
        return $this->view->render($response, 'auth/recover-password.php');
    }
	
    public function postRecoverPassword(ServerRequestInterface $request, ResponseInterface $response) {
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
