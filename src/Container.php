<?php

namespace App;

/**
 * Fa un registre de serveis
 */
final class Container {
	protected static $services = [];
	
	public static function bind($key,$value) {
		self::$services[$key] = $value;
	}
	public static function get($key) {
		
		if (!array_key_exists($key, self::$services)) {
			
			throw new \Exception("Service {$key} is NOT bound in container");
		}
		////var_dump($key);
		//die();
		return self::$services[$key];
		

	}
}