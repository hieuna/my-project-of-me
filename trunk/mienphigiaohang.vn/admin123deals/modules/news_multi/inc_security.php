<?
require_once("../../resource/security/security.php");

$module_id	= 52;
$module_name= "tin tức";
//Check user login...
checkLogged();
//Check access module...
//if(checkAccessModule($module_id) != 1) redirect($fs_denypath);

//Declare prameter when insert data
$fs_table		= "tintuc";
$id_field		= "MaTin";
$name_field		= "TieuDe";
$break_page		= "{---break---}";
$fs_insert_logo  		= 0;
$fs_fieldupload  		= "Anh";
$fs_filepath   			= "../../../pictures/tintuc/";
$fs_extension   		= "gif,jpg,jpe,jpeg,png";
$fs_filesize   			= 5000;
$width_small_image 		= 105;
$height_small_image 	= 105;
$width_normal_image 	= 105;
$height_normal_image	= 105;
  $arrayLocation = array(   '' =>"--[Chọn loại tin]--",
                        1 =>"Tin Khuyến mại",
                        2 =>"Tin Thể thao",
                        3 =>"Tin giải trí",
						4 =>"Tin công nghệ",
						5 =>"Ảnh Người đẹp",
                        6 =>"Ảnh Ngôi sao sân cỏ",
                        7 =>"Ảnh Vợ, bồ cầu thủ",
						8 =>"Ảnh Ô tô xe máy",
						9 =>"Videos Người đẹp",
                        10 =>"Videos tổng hợp trận đấu",
						11 =>"Videos Hài",
                        );
 $arrayLoca = array(   '' =>"--[Chọn loại tin bài]--",
                        1 =>"Tin tức",
                        2 =>"Photos",
                        3 =>"Videos",
                        );
?>