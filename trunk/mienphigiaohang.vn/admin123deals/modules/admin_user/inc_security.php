<?
require_once("../../resource/security/security.php");

$module_id	= 49;
$module_name= "Admin - User";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table	= "admin_user";
$id_field	= "adm_id";
?>