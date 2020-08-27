<?php

namespace Base\Validation;

use Base\Helpers\Session;
use Psr\Http\Message\ServerRequestInterface;
use Base\Validation\Contracts\ValidatorInterface;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator implements ValidatorInterface {
	
    protected $errors = [];

    public function validate(ServerRequestInterface $request, array $rules) {
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
