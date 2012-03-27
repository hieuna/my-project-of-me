<?
require_once("../../resource/security/security.php");
require_once("../../../functions/rewrite_functions.php");

$module_id	= 64;
$module_name= "Quản trị đơn hàng";
//Check user login...
checkLogged();
//Check access module...
if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table		= "cart_multi";
$id_field		= "Id";
$name_field		= "pro_id";
$break_page		= "{---break---}";
$arraypaymenttype = array(  1 =>"Thanh toán và nhận phiếu tại nhà",
                        	2 =>"Nhận tại 123re.vn",                      
                        );
$arraycartstatus = array(   1 =>"Đang xử lý",
                        	2 =>"Hoàn tất",   
							3 =>"Đơn hàng hủy",                   
                        );	
   $arraylocal = array(  
   0 =>"Chọn thành phố",
   1 =>"Hà Nội",
   2 =>"Hồ Chí Minh",                      
                        );              
						
?>