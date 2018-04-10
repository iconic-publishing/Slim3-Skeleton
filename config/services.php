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
    | Services Configurations
    |--------------------------------------------------------------------------
    |
    | All configurations are done via the .env file within the root.
	| DO NOT MAKE ANY CHANGES HERE.
    |
    */

	'mailgun' => [
        'domain' => getenv('MAILGUN_DOMAIN'),
        'host' => getenv('MAILGUN_HOST', 'smtp.mailgun.org'),
		'api' => getenv('MAILGUN_API'),
		'from' => getenv('MAILGUN_FROM', 'noreply@example.com')
	],
	
	'twilio' => [
		'sid' => getenv('TWILIO_SID'),
		'token' => getenv('TWILIO_TOKEN'),
		'number' => getenv('TWILIO_NUMBER', '+66000000000'),
		'companyNumber' => getenv('TWILIO_COMPANY_NUMBER', '+66000000000')
	],
	
	'recaptcha' => [
		'siteKey' => getenv('RECAPTCHA_SITE_KEY'),
		'secretKey' => getenv('RECAPTCHA_SECRET_KEY')
	],
	
	'stripe' => [
		'secret' => getenv('STRIPE_SECRET'),
		'public' => getenv('STRIPE_PUBLIC'),
		'currency' => getenv('STRIPE_CURRENCY', 'USD')
	],
	
	'mailchimp' => [
        'api' => getenv('MAILCHIMP_API'),
        'list' => [
			'customer' => getenv('MAILCHIMP_LIST_CUSTOMER')
		],
		'count' => getenv('MAILCHIMP_COUNT', 10000)
	],
	
	'gmaps' => [
		'api' => getenv('GMAPS_API')
	]

];