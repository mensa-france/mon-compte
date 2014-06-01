<?php

require_once __DIR__.'/../../vendor/autoload.php';

use MonCompte\LemonLdap;

echo LemonLdap::getCurrentUserId();
