<?php
//$dotenv = \Dotenv\Dotenv::createImmutable(APP);
//$dotenv->load();

define('ROOT', $_ENV['ROOT']);


use App\Container;
use App\Database\DB;
use App\Database\Connection;
use App\Session;

$config=Container::bind('config',
	require 'config.php'
);
//$config=require 'config.php';

Container::bind('database',
	new DB(
		Connection::make(
			Container::get('config')
		)
	)
);