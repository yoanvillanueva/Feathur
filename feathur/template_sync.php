<?php
include('./includes/loader.php');
session_write_close();

$uTemplate = $_GET['template'];

if($sTemplate = $database->CachedQuery("SELECT * FROM `templates` WHERE `path` = :Template", array("Template" => $uTemplate))){
	$sTemplate = new Template($sTemplate->data[0]["id"]);
	header('Content-type: application/iso');
	header('Content-Disposition: attachment; filename="'.$sTemplate->sPath.'.iso"');
	ob_end_clean();
	$sData = @fopen("/var/feathur/data/templates/kvm/{$sTemplate->sPath}.iso", "rb");
	fpassthru($sData);
	fclose($sData);
} else {
	die();
}