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
    | Meta Tags
    |-----------------------------------------------------------------
    |
    | Meta Tags can be added here to fit your project.
    |
    | All configurations are done via the .env file within the root.
    |
    */

    'meta' => [
        'robots' => 'index, follow',
        'robotsAdmin' => 'noindex, nofollow',
        'copyright' => '© Copyright ' . date('Y') . ' ' . getenv('COPYRIGHT_NAME', 'Copyright Name') . '. All Rights Reserved',
        'author' => 'Iconic Publishing Co Ltd - https://www.iconic-publishing.com'
    ]

];