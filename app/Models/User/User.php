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
use Base\Models\User\UserPermission;

class User extends Model {
	
	protected $table = 'users';

    protected $fillable = [
		'username',
		'email_address',
		'first_name',
		'last_name',
		'mobile_number',
		'password',
		'token',
		'active',
		'locked',
		'active_hash',
		'recover_hash',
		'remember_identifier',
		'remember_token'
	];
	
	public function permissions() {
		return $this->hasOne(UserPermission::class, 'user_id');
	}
	
	public function hasPermission($permission) {
		return (bool) $this->permissions->{$permission};
	}
	
	public function isAdministrator() {
		return $this->hasPermission('is_administrator');
	}
	
	public function isAdmin() {
		return $this->hasPermission('is_admin');
	}
	
	public function isStaff() {
		return $this->hasPermission('is_staff');
	}
	
	public function isUser() {
		return $this->hasPermission('is_user');
	}
	
	public function isGroup() {
		if($this->isAdministrator() || $this->isAdmin() || $this->isStaff()) {
			return $this;
		}
	}
	
	public function isUserType() {
		if($this->isAdministrator()) {
			return 'You are an Administrator';
		} else if($this->isAdmin()) {
			return 'You are Admin Staff';
		} else if($this->isStaff()) {
			return 'You are Staff';
		} else {
			return 'You are a Member';
		}
	}
	
	public function activateAccount() {
		$this->update([
			'active' => true,
			'locked' => false,
			'active_hash' => null
		]);
	}

	public function updateRememberCredentials($identifier, $token) {
		$this->update([
			'remember_identifier' => $identifier,
			'remember_token' => $token
		]);
	}

	public function removeRememberCredentials() {
		$this->updateRememberCredentials(null, null);
	}
	
	public function createLoginToken($token) {
		$this->update([
			'token' => $token
		]);
	}
	
	public function removeLoginToken() {
		$this->createLoginToken(null);
	}

	public function getFirstName() {
		if($this->first_name) {
			return $this->first_name;
		}
		
		return null;
	}
	
	public function getFullName() {
		if($this->first_name && $this->last_name) {
			return "{$this->first_name} {$this->last_name}";
		}
		
		if($this->first_name) {
			return $this->first_name;
		}
		
		return null;
	}
	
	public function getNameOrUsername() {
		return $this->getFullName() ?: $this->username;
	}
	
	public function getFirstNameOrUsername() {
		return $this->first_name ?: $this->username;
	}

}
