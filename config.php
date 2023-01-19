<?php
// dades d'accés a .env
return [
	'dbuser' => $_ENV['DB_USER'],
	'dbpassword' => $_ENV['DB_PASSWORD'],
	'dbname' => $_ENV['DB_NAME'],
	'connection' => $_ENV['DB_DRIVER'] . ':host=' . $_ENV['DB_HOST'],
	'options' => [
		\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
	]
];

/* 
$dbhost = "localhost";
$dbname = "librarydb";

$dsn = "mysql:host=${dbhost};dbname=${dbname};charset=utf8mb4";

$dbuser = $dbname."admin";
$dbpass = "linuxlinux";
	*/