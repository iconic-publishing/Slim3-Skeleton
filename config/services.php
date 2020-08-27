<?php

return [

    'mail' => [
        'host' => getenv('MAILGUN_HOST'),
        'port' => getenv('MAILGUN_PORT'),
        'encryption' => getenv('MAILGUN_ENCRYPTION'),
        'username' => getenv('MAILGUN_USERNAME'),
        'password' => getenv('MAILGUN_PASSWORD'),
        'from' => [
            'address' => getenv('MAILGUN_FROM_ADDRESS'),
            'name' => getenv('MAILGUN_FROM_NAME')
        ]
    ],

    'twilio' => [
        'sid' => getenv('TWILIO_SID'),
        'token' => getenv('TWILIO_TOKEN'),
        'number' => getenv('TWILIO_NUMBER'),
        'companyNumber' => getenv('TWILIO_COMPANY_NUMBER')
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