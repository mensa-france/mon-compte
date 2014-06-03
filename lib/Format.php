<?php

namespace MonCompte;

use DateTime;

class Format {
	public static function date($value) {
		$result =  $value->format('Y-m-d');

		if ($result == '-0001-11-30') // Then date in db is 0000-00-00
			return null;

		return $result;
	}

	public static function filterDateTime($dateTime) {
		if (!$dateTime)
			$dateTime = null;
		else if (!($dateTime instanceof DateTime))
			$dateTime = new DateTime($dateTime);

		return $dateTime;
	}
}
