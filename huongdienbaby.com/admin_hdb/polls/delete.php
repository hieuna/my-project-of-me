<?
require_once("config_security.php");
$iPol = getValue("iPol","int","GET",0);
$db_del = new db_execute("DELETE FROM polls WHERE pol_id = " . $iPol);
unset($db_del);
if ($iPol != 0){
	$db_del = new db_execute("DELETE FROM polls WHERE pol_parent_id = " . $iPol);
	unset($db_del);
}
redirect("listing.php"); 
?>