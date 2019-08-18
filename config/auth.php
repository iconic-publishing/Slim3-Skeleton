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
    | Authentication Settings
    |-----------------------------------------------------------------
    |
    | All configurations are done via the .env file within the root.
	| DO NOT MAKE ANY CHANGES HERE.
    |
    */
	
    'auth' => [
        'remember' => 'user_r',
        'token' => getenv('AUTH_TOKEN', 32),
        'register' => getenv('AUTH_REGISTER', 32),
        'recover' => getenv('AUTH_RECOVER', 32)
    ]

];