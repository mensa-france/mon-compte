<?php

namespace MonCompte;

class Format {
	public static function date($value) {
		return $value->format('Y-m-d');
	}
}
