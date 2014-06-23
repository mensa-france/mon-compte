<?php

require_once __DIR__.'/../../vendor/autoload.php';

use MonCompte\LemonLdap;
use MonCompte\Doctrine;
use MonCompte\Logger;
use Valitron\Validator;

function getArrayValue($array, $key) {
	if (!isset($array[$key]))
		$array[$key] = [];

	return $array[$key];
}

$logger = Logger::getLogger('services/saveProfile');

$currentUserId = LemonLdap::getCurrentUserId();
$logger->debug("Found current user id: {$currentUserId}");
$logger->debug("Reveived form data: ".print_r($_POST,true));

$v = new Validator($_POST);

$v->rule('required',[
	'adresse1',
	'codePostal',
	'ville',
	'pays',
])->message('{field} doit être renseigné.');

$v->rule('email','email')->message('{field} n\'est pas une adresse email valide.');
$v->rule('in','statut',[null,'','single','couple','deceased'])->message('{field} n\'est pas valide.');
$v->rule('integer','enfants')->message('{field} n\'est pas un nombre entier.');

header('Content-Type: application/json');

if ($v->validate()) {
	$formValues = $_POST;

	$foundProfile = Doctrine::findMembre($currentUserId);

	// Don't generate method calls to avoid potential security hole.
	$foundProfile->setStatut($formValues['statut']);
	$foundProfile->setEnfants($formValues['enfants']);
	$foundProfile->setDevise($formValues['devise']);

	$foundProfile->setCoordonnee('email', $formValues['email'], $formValues['emailPrive']);
	$foundProfile->setCoordonnee('phone', $formValues['telephone'], $formValues['telephonePrive']);

	$adresseValue = [
		'address' => trim("{$formValues['adresse1']}\n{$formValues['adresse2']}"),
		'code' => $formValues['codePostal'],
		'city' => $formValues['ville'],
		'country' => $formValues['pays'],
	];
	$foundProfile->setCoordonnee('address', json_encode($adresseValue), $formValues['adressePrivee']);

	$foundProfile->setLangues(getArrayValue($formValues, 'langues'));
	$foundProfile->setCompetences(getArrayValue($formValues, 'competences'));
	$foundProfile->setPassions(getArrayValue($formValues, 'passions'));

	Doctrine::persist($foundProfile);
	Doctrine::flush();

	//echo json_encode($sentProfile);
	echo json_encode($foundProfile);
} else {
	$logger->info('Found validation errors: '.print_r($v->errors(),true));

	$errors = [];

	foreach ($v->errors() as $fieldName => $fieldErrors) {
		foreach ($fieldErrors as $message) {
			$errors[] = $message;
		}
	}

	$logger->info('Found validation errors: '.print_r($errors,true));

	echo json_encode(['errors'=>$errors]);
}
