<?php

require_once __DIR__.'/../../vendor/autoload.php';

use MonCompte\LemonLdap;
use MonCompte\Doctrine;
use MonCompte\Logger;
use MonCompte\LdapSync;
use MonCompte\Format;
use Valitron\Validator;

function getArrayValue($array, $key) {
	if (!isset($array[$key]))
		$array[$key] = [];

	return $array[$key];
}

$logger = Logger::getLogger('services/saveProfile');

$numeroMembre = LemonLdap::getCurrentUserId();
$logger->debug("Found current user id: {$numeroMembre}");
//$logger->debug("Reveived form data: ".print_r($_POST,true));

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

$MAX_LENGTHS = [
	'adresse1' => 35,
	'adresse2' => 35,
	'adresse3' => 35,
	'codePostal' => 20,
	'ville' => 50,
	'pays' => 50,
	'telephone' => 20,
	'email' => 127,
];

header("Content-type: application/json; charset=utf-8'");

if ($v->validate()) {
	$formValues = $_POST;

	foreach ($MAX_LENGTHS as $key => $value)
		$formValues[$key] = Format::limitLength($formValues[$key], $MAX_LENGTHS[$key]);

	$foundProfile = Doctrine::findMembre($numeroMembre);

	// Don't generate method calls to avoid potential security hole.
	$foundProfile->setStatut($formValues['statut']);
	$foundProfile->setEnfants($formValues['enfants']);
	$foundProfile->setDevise($formValues['devise']);

	$foundProfile->setCoordonnee('email', $formValues['email'], $formValues['emailPrive']);
	$foundProfile->setCoordonnee('phone', $formValues['telephone'], $formValues['telephonePrive']);

	$adresseValue = [
		'address' => trim("{$formValues['adresse1']}\n{$formValues['adresse2']}\n{$formValues['adresse3']}"),
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

	$ldapResult = LdapSync::updateProfile($numeroMembre, $foundProfile->jsonSerialize());

	if ($ldapResult) {
		// Then it's an error.
		$logger->error("Ldap error updating status for #{$numeroMembre}: {$ldapResult}");
	}

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
