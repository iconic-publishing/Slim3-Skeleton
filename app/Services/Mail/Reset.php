<?php

namespace Base\Services\Mail;

use Base\Models\User\User;
use Base\Services\Mail\Mailer\Mailable;

class Reset extends Mailable {
	
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }
	
    public function build() {
        return $this->subject(getenv('MAILGUN_FROM_NAME', 'Company Name') . ' - Password Reset')
            ->view('includes/services/emails/reset-password.php')
            ->with([
                'user' => $this->user
            ]);
    }
	
}