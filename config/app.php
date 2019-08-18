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
    |--------------------------------------------------------------------------
    | Application Settings
    |--------------------------------------------------------------------------
    |
    | All configurations are done via the .env file within the root.
	| DO NOT MAKE ANY CHANGES HERE.
    |
    */
	
    'app' => [
        'timezone' => getenv('TIMEZONE', 'Asia/Bangkok'),
        'displayErrors' => getenv('DISPLAY_ERRORS', 'Off'),
        'locale' => getenv('LOCALE', 'en'),
        'onContextMenu' => 'return ' . getenv('ON_CONTEXT_MENU', 'false'),
        'autocomplete' => getenv('AUTO_COMPLETE', 'Off')
    ]

];
