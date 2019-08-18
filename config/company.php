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
    | Project Settings
    |-----------------------------------------------------------------
    |
    | All configurations are done via the .env file within the root.
    | DO NOT MAKE ANY CHANGES HERE TO THE 'contactFormEmail'.
    |
    | Changes to 'name', 'phone', 'address1', 'address2', 'address3', 'address4'
    | and 'email' can be done here. More fields can be added to fit your project.
    |
    */
	
    'company' => [
        'name' => getenv('COMPANY_NAME', 'Iconic Publishing Co Ltd'),
        'phone' => getenv('COMPANY_PHONE', '+66 (0)33 005 922'),
        'address1' => getenv('COMPANY_ADDRESS_1', 'Address Line 1'),
        'address2' => getenv('COMPANY_ADDRESS_2', 'Address Line 2'),
        'address3' => getenv('COMPANY_ADDRESS_3', 'Address Line 3'),
        'address4' => getenv('COMPANY_ADDRESS_4', 'Address Line 4'),
        'email' => getenv('COMPANY_EMAIL', 'info@example.com'),
        'contactFormEmail' => getenv('CONTACT_FORM_EMAIL', 'enquiries@example.com')
    ]

];