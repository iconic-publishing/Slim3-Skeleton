<?php

namespace Base\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Base\Models\User\User;

class EmailAvailable extends AbstractRule {
	
    public function validate($input) {
        return User::where('email_address', $input)->count() === 0;
    }
	
}
