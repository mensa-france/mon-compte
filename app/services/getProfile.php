<?php

require_once __DIR__.'/../../vendor/autoload.php';

use MonCompte\LemonLdap;
use MonCompte\Doctrine;
use MonCompte\Log4php;

$logger = Log4php::getLogger('services/getProfile');

$FIELDS = [
	'nom',
	'prenom',
	'statut',
	'enfants',
	'civilite',
	'genre',
	'dateNaissance',
	'dateInscription',
	'region',
	'devise',
];

function parseValue($value) {
	global $logger;

	$logger->debug(print_r($value,true));

	if ($value instanceof DateTime)
		$value = $value->format('Y-m-d');

	return $value;
}

$currentUserId = LemonLdap::getCurrentUserId();
$logger->debug("Found current user id: {$currentUserId}");

$foundProfile = Doctrine::findMembre($currentUserId);

$sentProfile = [];

foreach ($FIELDS as $attr)
	$sentProfile[$attr] = parseValue($foundProfile->{'get'.strtoupper(substr($attr,0,1)).substr($attr,1)}());

$sentProfile['coordonnees'] = [];

foreach ($foundProfile->getCoordonnees() as $coord) {
	$coordonnee = [];
	$coordonnee['id'] = $coord->getIdCoordonnee();
	$coordonnee['type'] = $coord->getTypeCoordonnee();
	$coordonnee['value'] = $coord->getCoordonnee();

	if ($coordonnee['type'] == "address")
		$coordonnee['value'] = json_decode($coordonnee['value']);

	$coordonnee['private'] = $coord->getReserveeGestionAsso();

	$sentProfile['coordonnees'][] = $coordonnee;
}

header('Content-Type: application/json');
echo json_encode($sentProfile);
