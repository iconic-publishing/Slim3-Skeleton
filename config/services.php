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

return [
	
    /*
    |-----------------------------------------------------------------
    | Services Configurations
    |-----------------------------------------------------------------
    |
    | All configurations are done via the .env file within the root.
    | DO NOT MAKE ANY CHANGES HERE.
    |
    */

    'mail' => [
        'host' => getenv('MAILGUN_HOST', 'smtp.mailgun.org'),
        'port' => getenv('MAILGUN_PORT', 587),
        'encryption' => getenv('MAILGUN_ENCRYPTION', 'tls'),
        'username' => getenv('MAILGUN_USERNAME', ''),
        'password' => getenv('MAILGUN_PASSWORD', ''),
        'from' => [
            'address' => getenv('MAILGUN_FROM_ADDRESS', 'noreply@example.com'),
            'name' => getenv('MAILGUN_FROM_NAME', 'Iconic Publishing Co Ltd')
        ]
    ],

    'twilio' => [
        'sid' => getenv('TWILIO_SID'),
        'token' => getenv('TWILIO_TOKEN'),
        'number' => getenv('TWILIO_NUMBER', '+66000000000'),
        'companyNumber' => getenv('TWILIO_COMPANY_NUMBER', '+66000000000')
    ],

    'recaptcha' => [
        'siteKey' => getenv('RECAPTCHA_SITE_KEY'),
        'secretKey' => getenv('RECAPTCHA_SECRET_KEY'),
        'locale' => getenv('RECAPTCHA_LOCALE', 'en')
    ],

    'gmaps' => [
        'api' => getenv('GMAPS_API')
    ],

    'stripe' => [
        'secret' => getenv('STRIPE_SECRET'),
        'public' => getenv('STRIPE_PUBLIC'),
        'currency' => getenv('STRIPE_CURRENCY', 'USD')
    ],

    'mailchimp' => [
        'api' => getenv('MAILCHIMP_API'),
        'list' => [
            'server' => getenv('MAILCHIMP_LIST_SERVER'),
            'name' => getenv('MAILCHIMP_LIST_NAME')
        ],
        'gdpr' => [
            'email' => getenv('MAILCHIMP_GDRP_EMAIL'),
            'direct' => getenv('MAILCHIMP_GDRP_DIRECT'),
            'ads' => getenv('MAILCHIMP_GDRP_ADS')
        ],
        'count' => getenv('MAILCHIMP_COUNT', 10000)
    ]

];