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

namespace Base\Services\Mail;

use Base\{
	Services\Mail\Mailer\Mailable,
	Models\User\User
};

class Activation extends Mailable {
	
	protected $user;
	protected $identifier;

    public function __construct(User $user, $identifier) {
        $this->user = $user;
		$this->identifier = $identifier;
    }
	
    public function build() {
        return $this->subject(getenv('MAILGUN_FROM_NAME', 'Company Name') . ' - Account Activation')
            ->view('includes/services/emails/activation.php')
			->with([
                'user' => $this->user,
				'identifier' => $this->identifier
            ]);
    }
	
}