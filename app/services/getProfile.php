<?php

require_once __DIR__.'/../../vendor/autoload.php';

use MonCompte\LemonLdap;
use MonCompte\Doctrine;
use MonCompte\Logger;

$logger = Logger::getLogger('services/getProfile');

$currentUserId = LemonLdap::getCurrentUserId();
$logger->debug("Found current user id: {$currentUserId}");

$foundProfile = Doctrine::findMembre($currentUserId);

header("Content-type: application/json; charset=utf-8'");
//echo json_encode($sentProfile);
echo json_encode($foundProfile);
