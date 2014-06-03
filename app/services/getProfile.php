<?php

require_once __DIR__.'/../../vendor/autoload.php';

use MonCompte\LemonLdap;
use MonCompte\Doctrine;
use MonCompte\Log4php;

$logger = Log4php::getLogger('services/getProfile');

$currentUserId = LemonLdap::getCurrentUserId();
$logger->debug("Found current user id: {$currentUserId}");

$foundProfile = Doctrine::findMembre($currentUserId);

header('Content-Type: application/json');
//echo json_encode($sentProfile);
echo json_encode($foundProfile);
