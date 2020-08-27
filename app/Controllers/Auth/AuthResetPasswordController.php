<?php

namespace Base\Controllers\Auth;

use Base\Helpers\Session;
use Base\Models\User\User;
use Base\Services\Mail\Reset;
use Base\Constructor\BaseConstructor;
use Psr\Http\Message\ResponseInterface;
use Base\Validation\Forms\Auth\AuthForm;
use Psr\Http\Message\ServerRequestInterface;

class AuthResetPasswordController extends BaseConstructor {
	
    public function getResetPassword(ServerRequestInterface $request, ResponseInterface $response, $args) {
        $email = $args['email_address'];
        $user = User::where('email_address', $email)->first();

        if($user->recover_hash == null) {
            return $response->withRedirect($this->router->pathFor('getLogin'));
        }

        return $this->view->render($response, 'auth/reset-password.php', compact('user'));
    }

    public function postResetPassword(ServerRequestInterface $request, ResponseInterface $response, $args) {
        $email_address = $args['email_address'];

        $validation = $this->validator->validate($request, AuthForm::resetPasswordRules());

        if($validation->fails()) {
            $this->flash->addMessage('error', $this->config->get('messages.reset.required'));
            return $response->withRedirect($this->router->pathFor('getResetPassword', compact('email_address')));
        }

        $user = User::where('email_address', $email_address)->first();

        $identifier = $user->recover_hash;
        $password = $request->getParam('password');

        if(!$user || !$this->hash->hashCheck($user->recover_hash, $identifier)) {
            $this->flash->addMessage('error', $this->config->get('messages.reset.error'));
            return $response->withRedirect($this->router->pathFor('getResetPassword', compact('email_address')));
        } else {
            $user->update([
                'password' => $this->hash->password($password),
                'recover_hash' => null
            ]);

            $this->mail->to($user->email_address, $this->config->get('mail.from.name'))->send(new Reset($user));

            /*
            Send SMS to User
            */
            $number = $user->mobile_number;
            $body = $this->view->fetch('includes/services/sms/reset-password.php', compact('user'));
            $this->sms->send($number, $body);

            Session::delete('old');

            $this->flash->addMessage('success', $this->config->get('messages.reset.success'));
            return $response->withRedirect($this->router->pathFor('getLogin'));
        }
    }

}
