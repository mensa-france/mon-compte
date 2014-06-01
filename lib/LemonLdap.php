<?php

namespace MonCompte;

class LemonLdap {
	public static function getCurrentUserId() {
		$headers = getallheaders();

		if (isset ($headers['Auth-User']))
			return $headers['Auth-User'];

		return false;
	}
}
