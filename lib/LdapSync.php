<?php

namespace MonCompte;

class LdapSync {
	private static $logger;

	private static $conf;
	private static $ldapHandle;
	private static $isDisabled;

	private static function loadConfiguration() {
		$strCfg = file_get_contents(__DIR__.'/../config/local_ldap.json');
		self::$conf = json_decode($strCfg, true);
		self::$isDisabled = self::$conf['disabled'] === true;
		return self::$conf;
	}

	/**
	 * Returns ldap handle if successful, false otherwise.
	 */
	private static function openLdapConnection($host, $port, $userdn, $password) {
		$handle_ldap = ldap_connect($host, $port);

		ldap_set_option($handle_ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($handle_ldap, LDAP_OPT_REFERRALS, 0);

		if (!ldap_bind($handle_ldap, $userdn, $password))
			$handle_ldap = false;

		self::$ldapHandle = $handle_ldap;

		return $handle_ldap;
	}

	private static function initialize() {
		if (!self::$conf) {
			self::$logger = Logger::getLogger('LdapSync');
			self::loadConfiguration();

			if (!self::$isDisabled)
				self::openLdapConnection(self::$conf['host'],self::$conf['port'],self::$conf['userdn'],self::$conf['password']);
		}

		return self::$ldapHandle;
	}

	public static function updateProfile($numero_membre, $data) {
		$handle_ldap = self::initialize();

		if (self::$isDisabled) {
			self::$logger->info("Ldap is disabled, doing nothing.");
			return false;
		}

		$membreExists = @ldap_search($handle_ldap, "cn={$numero_membre}, ".self::$conf['basedn'], "objectclass=*", array("cn", "description", "mail"));

		if($membreExists) {
			$personnes = ldap_get_entries($handle_ldap, $membreExists);
			$personne = $personnes[0];
			$dn = $personne["dn"];

			//self::$logger->debug(print_r($personne, true));

			$newEmail = self::$conf['defaultEmail'];

			if (isset($data['email']) && $data['email'])
				$newEmail = $data['email'];

			$hasLdapEmail = @is_array($personne["mail"]);

			$ldapData = [
				'mail' => [$newEmail]
			];

			if($hasLdapEmail) {
				self::$logger->info("Replacing ldap email for #{$numero_membre}: {$newEmail}");
				ldap_mod_replace($handle_ldap, $dn, $ldapData);
			} else {
				self::$logger->info("Adding ldap email for #{$numero_membre}: {$newEmail}");
				ldap_mod_add($handle_ldap, $dn, $ldapData);
			}

			$err = ldap_error($handle_ldap);
			if($err != "Success")
				return $err;
		} else {
			return "Membre not found in ldap repo: #{$numero_membre}";
		}
	}
}
