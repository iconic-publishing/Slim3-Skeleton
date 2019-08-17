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

use Swift_Message;
use Swift_Attachment;

class MessageBuilder {
	
    protected $swiftMessage;

    public function __construct(Swift_Message $swiftMessage) {
        $this->swiftMessage = $swiftMessage;
    }

    public function to($address, $name = null) {
        $this->swiftMessage->setTo($address, $name);

        return $this;
    }

    public function subject($subject) {
        $this->swiftMessage->setSubject($subject);

        return $this;
    }

    public function attach($file) {
        $this->swiftMessage->attach(Swift_Attachment::fromPath($file));

        return $this;
    }

    public function body($body) {
		$this->swiftMessage->addPart($body, 'text/plain');

        return $this;
    }

    public function from($address, $name = null) {
        $this->swiftMessage->setFrom($address, $name);

        return $this;
    }

    public function getSwiftMessage() {
        return $this->swiftMessage;
    }
	
}