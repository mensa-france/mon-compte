<?php

namespace MonCompte;

require_once __DIR__."/../vendor/autoload.php";

class Logger {
	private static $logger;

	public static function getLogger($name) {
		if (!self::$logger)
			self::$logger = new \Katzgrau\KLogger\Logger(__DIR__.'/../logs');

		return self::$logger;
	}
}
