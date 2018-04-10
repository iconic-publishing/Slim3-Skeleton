<?php
/********************************************************************
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ 
@Author			John Hoddy <john.hoddy@iconic-publishing.com>
@Website		https://www.iconic-publishing.com
@Created		Monday, 12th March, 2018

© Copyright 2014 - 2018 Iconic Publishing Co Ltd. All Rights Reserved
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
Change Request ID: 

~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
*********************************************************************/

require_once __DIR__ . '/bootstrap/app.php';

$config = $container->config->get('database');

return [
 	
	'paths' => [
		'migrations' => 'database/migrations'
	],
	
	'migration_base_class' => 'Base\Database\Migrations\Migration',
	
	'templates' => [
		'file' => 'app/Database/Migrations/MigrationStub.php'
	],
	
	'environments' => [
		'default_migration_table' => '_migrations',
		'default' => [
			'adapter' => $config['driver'],
			'host' => $config['host'],
			'port' => $config['port'],
			'name' => $config['database'],
			'user' => $config['username'],
			'pass' => $config['password']
		]
	]

];