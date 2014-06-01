<?php
// bootstrap.php
require_once __DIR__."/../../vendor/autoload.php";
require_once __DIR__."/../../config/local_doctrine.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

$paths = [__DIR__."/Entities"];

//$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

$config = Setup::createConfiguration($isDevMode);
$driver = new AnnotationDriver(new AnnotationReader(), $paths);

// registering noop annotation autoloader - allow all annotations by default
AnnotationRegistry::registerLoader('class_exists');
$config->setMetadataDriverImpl($driver);


$entityManager = EntityManager::create($dbParams, $config);
