<?php

function getLemonLdapUserId() {
	$headers = getallheaders();
	
	if (isset ($headers['Auth-User']))
		return $headers['Auth-User'];

	return false;
}