<?php

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
