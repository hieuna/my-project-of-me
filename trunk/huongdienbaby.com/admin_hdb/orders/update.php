<?
require_once("config_security.php");

$returnurl 		= base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id = getValue("record_id", "int", "GET");
$staus = getValue("staus", "int", "GET");
$db_del = new db_execute("UPDATE `orders` SET `ord_status` = '" . $staus  . "' WHERE ord_id =  " . $record_id . "");
unset($db_del);
redirect($returnurl);

?>