<?
require_once("config_security.php");
require_once("../../classes/database.php");
require_once("../../functions/functions.php");
$iPol = getValue("iPol","int","GET",0);
//deactive all
$str_query = "UPDATE polls SET pol_parent_active = 0";
$db_exec = new db_execute($str_query);
unset($db_exec);						   
//active poll
$str_query = "UPDATE polls SET pol_parent_active = 1 WHERE pol_id = " . $iPol;
$db_exec = new db_execute($str_query);
unset($db_exec);
redirect("listing.php"); 
?>