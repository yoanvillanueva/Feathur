<?php
include('./includes/loader.php');

$sSSH = new Net_SSH2('127.0.0.1');
$sKey = new Crypt_RSA();
$sKey->loadKey(file_get_contents($cphp_config->settings->rootkey));
if($sSSH->login("root", $sKey)) {
	$sSSH->exec("mkdir /var/feathur/data/keys;
				chmod 777 /var/feathur/data/keys;
				mkdir /var/feathur/data/templates/;
				mkdir /var/feathur/data/keys;
				mkdir /var/feathur/data/templates/openvz;
				chmod 777 /var/feathur/data/templates/;
				chmod 777 /var/feathur/data/templates/openvz;");
}

$sAdd = $database->prepare("ALTER TABLE `vps` ADD `rebuilding` INT( 2 ) NOT NULL AFTER `bandwidth_usage`;");
$sAdd->execute();