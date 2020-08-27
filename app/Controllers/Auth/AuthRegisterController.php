<?php

namespace Base\Controllers\Auth;

use Base\Helpers\Session;
use Base\Models\User\User;
use Base\Services\Mail\Activation;
use Base\Models\User\UserPermission;
use Base\Constructor\BaseConstructor;
use Psr\Http\Message\ResponseInterface;
use Base\Validation\Forms\Auth\AuthForm;
use Psr\Http\Message\ServerRequestInterface;

class AuthRegisterController extends BaseConstructor {
	
    public function getRegister(ServerRequestInterface $request, ResponseInterface $response) {
        return $this->view->render($response, 'auth/register.php');
    }

    public function postRegister(ServerRequestInterface $request, ResponseInterface $response) {
        $validation = $this->validator->validate($request, AuthForm::registerRules());

        if($validation->fails()) {
            $this->flash->addMessage('error', $this->config->get('messages.register.error'));
            return $response->withRedirect($this->router->pathFor('getRegister'));
        }

        $identifier = $this->hash->hashed($this->config->get('auth.register'));

        $user = User::create([
            'username' => mt_rand(100000, 999999),
            'email_address' => $request->getParam('email_address'),
            'first_name' => ucwords(strtolower($request->getParam('first_name'))),
            'last_name' => ucwords(strtolower($request->getParam('last_name'))),
            'mobile_number' => $request->getParam('mobile_number'),
            'password' => $this->hash->password($request->getParam('password')),
            'active' => false,
            'locked' => true,
            'active_hash' => $identifier
        ]);

        $user->permissions()->create(UserPermission::$user);

        $this->mail->to($user->email_address, $this->config->get('mail.from.name'))->send(new Activation($user, $identifier));

        /*
        Send SMS to New Registered User
        */
        $number = $request->getParam('mobile_number');
        $body = $this->view->fetch('includes/services/sms/activation.php', compact('user', 'identifier'));
        $this->sms->send($number, $body);

        Session::delete('old');

        $this->flash->addMessage('success', $this->config->get('messages.register.success'));
        return $response->withRedirect($this->router->pathFor('getLogin'));
    }

}
