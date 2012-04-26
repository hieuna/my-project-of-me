<?
include("config_security.php");
require_once("../../functions/functions.php");

$email		= getValue("email", "str", "GET", "", 1);
$redirect	= getValue("redirect", "str", "GET", base64_encode("email_listing.php"));
$db_delete	= new db_execute("DELETE FROM newsletter WHERE email = '" . $email . "'");
unset($db_delete);
redirect(base64_decode($redirect));
?>