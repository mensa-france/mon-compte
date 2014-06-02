<?php

namespace MonCompte;

require_once __DIR__."/../vendor/autoload.php";

use Logger;

Logger::configure(__DIR__.'/../config/log4php.php');

class Log4php {
	public static function getLogger($name) {
		return Logger::getLogger($name);
	}
}
