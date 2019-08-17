<?php
/********************************************************************
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ 
@Author			John Hoddy <john.hoddy@iconic-publishing.com>
@Website		https://www.iconic-publishing.com
@Created		Friday, 9th August, 2019

© Copyright 2014 - 2019 Iconic Publishing Co Ltd. All Rights Reserved
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
Change Request ID: 

~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
*********************************************************************/

namespace Base\Constructor;

use Interop\Container\ContainerInterface;

abstract class BaseConstructor {
	
	protected $container;
	
	public function __construct(ContainerInterface $container) {
		$this->container = $container;
	}
	
	public function __get($property) {
		if($this->container->{$property}) {
			return $this->container->{$property};
		}
	}
	
}

