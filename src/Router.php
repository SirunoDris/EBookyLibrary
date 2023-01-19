<?php
/*
namespace App;

class Router {
	function run() {

	}
	function get() {
		
	}
	function post() {
		
	}
}
*/
include APPSRC.'/routes.php';

/**
 * retorna controlador
 *
 * @return string
 */
function getRoute(array $routes):string {
	if ( isset($_REQUEST['url']) ) {
		$url = $_REQUEST['url'];
	} else {
		$url = 'home';
	}

	if (in_array($url, (array)$routes)) {
		return $url;
	} else {
		return 'error';
	}
}
?>