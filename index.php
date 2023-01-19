<?php
	ini_set('display_errors',1);
	
	// definir directori aplicació
	define("APP",__DIR__);
	define("APPSRC",APP.'/src');
	define("APPVIEWS",APPSRC.'/Views');

	// carregar autoload
	require_once APP.'/vendor/autoload.php';
	require_once APP.'/bootstrap.php';
	
	use App\App;

	// crida al controlador
	$app = new App();
?>
