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
