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
use Base\Validation\Forms\ContactForm;

class ContactController extends BaseConstructor {
	
	public function contact(Request $request, Response $response) {
        return $this->view->render($response, 'contact/contact.php');
    }
	
	public function contactSubmit(Request $request, Response $response) {
		$validation = $this->validator->validate($request, ContactForm::rules());

		if($validation->fails()) {
			$this->flash->addMessage('error', $this->config->get('messages.contact.error'));
			return $response->withRedirect($this->router->pathFor('contact'));
		}
		
		$data = [
			'full_name' => ucwords(strtolower($request->getParam('full_name'))),
			'email_address' => $request->getParam('email_address'),
			'mobile_number' => $request->getParam('mobile_number'),
			'country' => $request->getParam('country'),
			'department' => $request->getParam('department'),
			'subject' => ucwords(strtolower($request->getParam('subject'))),
			'message' => ucfirst($request->getParam('message'))
		];
		
		$to = $this->config->get('company.contactFormEmail');
		$subject = $this->config->get('company.name') . ' - Website Enquiry';
		$body = $this->view->fetch('includes/services/emails/contact.php', compact('data'));
		$this->mail->sendEmailWithApi($to, $subject, $body);
		
		unset($_SESSION['old']);
		
		$this->flash->addMessage('success', $this->config->get('messages.contact.success'));
		return $response->withRedirect($this->router->pathFor('contact'));
	}
	
}
