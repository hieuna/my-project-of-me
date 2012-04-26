<?
require_once("config_security.php");
$iPol		= getValue("iPol","int","GET",0);
$pol_name	= getValue("pol_name","str","GET","",1);
if ($pol_name != ""){
	$str_query = "UPDATE polls SET pol_name = '" . $pol_name . "' WHERE pol_id = " . $iPol;
	//echo $str_query;			   
	$db_exec = new db_execute($str_query);
	unset($db_exec);						   
}
redirect("listing.php"); 
?>