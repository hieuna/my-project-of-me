<?
require_once("../../resource/security/security.php");

$module_id	= 60;
$module_name= "Quản lý - User thành viên";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table	= "users";
$id_field	= "id";
$arraygroup_user = array(   3 =>"Thành viên",
                        	 1 =>"Đối tác",                      
                        );	
$array_sex = array(   0 =>"Nam",
					 1 =>"Nữ",                      
				);						
?>