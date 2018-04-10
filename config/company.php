<?php
/********************************************************************
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ 
@Author			John Hoddy <john.hoddy@iconic-publishing.com>
@Website		https://www.iconic-publishing.com
@Created		Monday, 12th March, 2018

© Copyright 2014 - 2018 Iconic Publishing Co Ltd. All Rights Reserved
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
Change Request ID: 

~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
*********************************************************************/

return [
	
	/*
    |--------------------------------------------------------------------------
    | Project Settings
    |--------------------------------------------------------------------------
    |
    | All configurations are done via the .env file within the root.
	| DO NOT MAKE ANY CHANGES TO THE 'contactFormEmail'.
	|
	| Changes to 'name', 'phone', 'address1', 'address2', 'address3', 'address4'
	| and 'email' can be done here. More fields can be added to fit your project.
    |
    */
	
	'company' => [
		'name' => '',
		'phone' => '',
		'address1' => '',
        'address2' => '',
        'address3' => '.',
        'address4' => '',
		'email' => '',
		'contactFormEmail' => getenv('CONTACT_FORM_EMAIL')
	]

];