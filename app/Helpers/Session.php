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

namespace Base\Helpers;

class Session {

	public static function exists($name) {
		return (isset($_SESSION[$name])) ? true : false;
	}

	public static function get($name) {
		return $_SESSION[$name];
	}
	
	public static function put($name, $value) {
		return $_SESSION[$name] = $value;
	}

	public static function delete($name) {
		if(self::exists($name)) {
			unset($_SESSION[$name]);
		}
	}

}