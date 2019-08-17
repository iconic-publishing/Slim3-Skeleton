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

namespace Base\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model {
	
    protected $table = 'users_permissions';

    protected $fillable = [
        'is_administrator',
        'is_admin',
        'is_staff',
        'is_user'
    ];

    public static $administrator = [
        'is_administrator' => true,
        'is_admin' => false,
        'is_staff' => false,
        'is_user' => false
    ];

    public static $admin = [
        'is_administrator' => false,
        'is_admin' => true,
        'is_staff' => false,
        'is_user' => false
    ];

    public static $staff = [
        'is_administrator' => false,
        'is_admin' => false,
        'is_staff' => true,
        'is_user' => false
    ];

    public static $user = [
        'is_administrator' => false,
        'is_admin' => false,
        'is_staff' => false,
        'is_user' => true
    ];
	
}
