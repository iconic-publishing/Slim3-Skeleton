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

namespace Base\Services\Mail\Mailer;

use Base\Services\Mail\Mailer\{
    MessageBuilder,
    Contracts\MailableInterface
};
use Slim\Views\Twig as View;
use Swift_Mailer;
use Swift_Message;

class Mailer {
	
    protected $swift;

    protected $view;

    protected $from = [];

    public function __construct(Swift_Mailer $swift, View $view) {
        $this->swift = $swift;
        $this->view = $view;
    }
	
	public function to($address, $name = null) {
        return (new PendingMailable($this))->to($address, $name);
    }

    public function alwaysFrom($address, $name = null) {
        $this->from = compact('address', 'name');

        return $this;
    }

    public function send($view, $viewData = [], Callable $callback = null) {
        if($view instanceof MailableInterface) {
            return $this->sendMailable($view);
        }

        $message = $this->buildMessage();

        call_user_func($callback, $message);

        $message->body($this->parseView($view, $viewData));

        return $this->swift->send($message->getSwiftMessage());
    }

    protected function sendMailable(Mailable $mailable) {
        return $mailable->send($this);
    }

    protected function buildMessage() {
        return (new MessageBuilder(new Swift_Message))->from($this->from['address'], $this->from['name']);
    }

    protected function parseView($view, $viewData) {
        return $this->view->fetch($view, $viewData);
    }
	
}