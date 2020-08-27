<?php

namespace Base\Validation\Forms;

use Respect\Validation\Validator as v;

class ContactForm {
	
    public static function contactRules() {
        return [
            'first_name' => v::notEmpty()->alpha(),
            'last_name' => v::notEmpty()->alpha(),
            'email_address' => v::noWhitespace()->notEmpty()->email(),
            'mobile_number' => v::notEmpty()->phone(),
            'country' => v::notEmpty(),
            'department' => v::notEmpty()->alpha(),
            'subject' => v::notEmpty(),
            'message' => v::notEmpty()
        ];
    }
	
}
