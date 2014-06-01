<?php

namespace MonCompte;

require_once __DIR__."/../vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

class Doctrine {
	private static $entityManager;

	private static function createEntityManager() {
		require __DIR__."/../config/local_doctrine.php";

		$paths = [__DIR__."/Entities"];

		$config = Setup::createConfiguration($isDevMode);
		$driver = new AnnotationDriver(new AnnotationReader(), $paths);

		// registering noop annotation autoloader - allow all annotations by default
		AnnotationRegistry::registerLoader('class_exists');
		$config->setMetadataDriverImpl($driver);

		self::$entityManager = EntityManager::create($dbParams, $config);
	}

	public static function getEntityManager() {
		if (!self::$entityManager)
			self::createEntityManager();

		return self::$entityManager;
	}
}
