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

namespace Base\Validation;

use Base\{
    Validation\Contracts\ValidatorInterface,
    Helpers\Session
};
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator implements ValidatorInterface {
	
    protected $errors = [];

    public function validate(Request $request, array $rules) {
        foreach($rules as $field => $rule) {
            $rule_title = ucfirst($field);

            $explode = explode('_', $rule_title);

            if(!isset($explode[1])) {
                $explode = explode('-', $rule_title);
            }

            if(isset($explode[1])) {
                $rule_title = implode(' ', $explode);
                $rule_title = ucwords(strtolower($rule_title));
            }

            try {
                $rule->setName($rule_title)->assert($request->getParam($field));
            } catch(NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        Session::put('errors', $this->errors);
        
        return $this;
    }

    public function fails() {
        return !empty($this->errors);
    }
	
}
