<?php

require_once __DIR__.'/../../vendor/autoload.php';

use MonCompte\LemonLdap;
use MonCompte\Doctrine;

$currentUserId = LemonLdap::getCurrentUserId();

$em = Doctrine::getEntityManager();

$query = $em->createQuery('SELECT m FROM MonCompte\Doctrine\Entities\Membres m WHERE m.idAncienSi = :id');
$query->setParameters([
	'id' => $currentUserId,
]);
$result = $query->getResult();

print_r($result[0]);
