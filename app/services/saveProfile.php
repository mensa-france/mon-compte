<?php

require_once __DIR__.'/../../vendor/autoload.php';

use MonCompte\LemonLdap;
use MonCompte\Doctrine;
use MonCompte\Log4php;
use Valitron\Validator;

$logger = Log4php::getLogger('services/saveProfile');

$currentUserId = LemonLdap::getCurrentUserId();
$logger->debug("Found current user id: {$currentUserId}");
$logger->debug("Reveived form data: ".print_r($_POST,true));

$v = new Validator($_POST);

$v->rule('required',[
	'nom',
	'prenom',
])->message('{field} doit être renseigné.');

$v->rule('dateFormat','dateNaissance','Y-m-d')->message('{field} n\'est pas une date valide.');

header('Content-Type: application/json');

if ($v->validate()) {
	$formValues = $_POST;

	$foundProfile = Doctrine::findMembre($currentUserId);

	// Don't generate method calls to avoid potential security hole.
	$foundProfile->setNom($formValues['nom']);
	$foundProfile->setPrenom($formValues['prenom']);
	$foundProfile->setCivilite($formValues['civilite']);
	$foundProfile->setStatut($formValues['statut']);
	$foundProfile->setEnfants($formValues['enfants']);
	$foundProfile->setDevise($formValues['devise']);
	$foundProfile->setDateNaissance($formValues['dateNaissance']);

	$foundProfile->setCoordonnee('email', $formValues['email']);
	$foundProfile->setCoordonnee('phone', $formValues['telephone']);

	$adresseValue = [
		'address' => trim("{$formValues['adresse1']}\n{$formValues['adresse2']}"),
		'code' => $formValues['codePostal'],
		'city' => $formValues['ville'],
		'country' => $formValues['pays'],
	];
	$foundProfile->setCoordonnee('address', json_encode($adresseValue));

	Doctrine::persist($foundProfile);
	Doctrine::flush();

	//echo json_encode($sentProfile);
	echo json_encode($foundProfile);
} else {
	print_r($v->errors());
}
