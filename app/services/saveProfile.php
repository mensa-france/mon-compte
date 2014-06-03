<?php

require_once __DIR__.'/../../vendor/autoload.php';

use MonCompte\LemonLdap;
use MonCompte\Doctrine;
use MonCompte\Log4php;

$logger = Log4php::getLogger('services/saveProfile');

$currentUserId = LemonLdap::getCurrentUserId();
$logger->debug("Found current user id: {$currentUserId}");
$logger->debug("Reveived form data: ".print_r($_POST,true));

$formValues = $_POST;

$foundProfile = Doctrine::findMembre($currentUserId);

$foundProfile->setNom($formValues['nom']);
$foundProfile->setPrenom($formValues['prenom']);
$foundProfile->setCivilite($formValues['civilite']);
$foundProfile->setStatut($formValues['statut']);
$foundProfile->setEnfants($formValues['enfants']);
$foundProfile->setDevise($formValues['devise']);

Doctrine::persist($foundProfile);
Doctrine::flush();

header('Content-Type: application/json');
//echo json_encode($sentProfile);
echo json_encode($foundProfile);
