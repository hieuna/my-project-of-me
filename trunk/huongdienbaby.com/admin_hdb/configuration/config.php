<?
require_once("config_security.php");
require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../classes/upload.php");
require_once("../../functions/file_functions.php");
require_once("../../functions/functions.php");
$type = getValue("type","int","GET",1);
//Khai bao Bien
$fs_table		= "configuration";
$fs_redirect	= "config.php?type=" . $type;
//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);
//array chua cac truong ko update
$arrayFieldNotUpdate = "'con_id','con_lang_id','con_mod_rewrite'";
$db_config	= new db_query("SELECT * FROM configuration WHERE con_lang_id = " . $lang_id);
$row			= mysql_fetch_array($db_config->result);
//array list update
$arrayField = array(
	// 1 ten truong, 2 kieu, 3 gia tri mac dinh, 4 chieu rong, 5 tieu de
	array("con_site_title",0,1000,90,"Tiêu đề trang","text")
	,array("con_admin_email",0,1000,90,"Địa chỉ email Admin","text")
	,array("con_wh_popup",1,1000,10,"Chiều rộng popup","text")
	//,array("con_page_size",1,1000,10,"Chiều rộng trang","text")
	//,array("con_left_size",1,180,10,"Chiều rộng menu trái","text")
	,array("con_home_product",1,180,10,"Sản phẩm trang chủ","text")
	,array("con_currency",0,180,10,"Đơn vị tiền tệ mặc định","text")
	,array("con_exchange",3,180,10,"Tỷ giá","text")
	,array("con_products_page",1,180,10,"Số sản phẩm / 1 trang","text")
	,array("con_news_new",1,180,10,"Số tin mới ở trang chủ","text")
	,array("con_news_page",1,180,10,"Số tin ở 1 trang","text")
	//,array("con_gallery_page",1,180,10,"Số ảnh  ở 1 trang(gallery)","text")
	//,array("con_limit_question",1,180,10,"Số câu hỏi đưa ra mỗi lần","text")
	//,array("con_diem_thuong",1,180,10,"% Điểm có thể lưu vào danh sách","text")
	,array("con_background",0,180,40,"Màu nền website","text")
	,array("con_extenstion",0,180,10,"Dạng đuôi (dạng url)","text")
	,array("con_support_online",0,180,90,"Hỗ trợ trực tuyến","textarea")
	,array("con_meta_description",0,180,90,"Thông tin chung ve website","textarea")
	,array("con_meta_keywords",0,180,90,"Từ khóa tìm kiếm (google,yahoo,...)<br> các từ khóa cách nhau bằng dấu phẩy","textarea")
	,array("con_hotkey",0,1000,90,"Hot keywords","text")
	,array("con_gmail_name",0,1000,90,"Địa chỉ Gmail liên hệ","text")
	,array("con_gmail_pass",0,1000,90,"Mật khẩu gmail liên hệ","pass")	
	,array("con_static_video",0,1000,90,"Video quảng cáo","text")
);

//Insert to database
for($i=0;$i<count($arrayField);$i++){
	$myform->add($arrayField[$i][0],$arrayField[$i][0],$arrayField[$i][1],0,"",0,"",0,"");
}
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");

if($action == "update"){
	//Check Error!
	$errorMsg .= $myform->checkdata();
	
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("con_lang_id",$_SESSION["lang_id"]));
		//echo $myform->generate_update_SQL("con_lang_id",$_SESSION["lang_id"]); die;
		//Redirect to:
		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("setting");
$myform->checkjavascript();
//Select data
$db_data = new db_query("SELECT * FROM configuration WHERE con_lang_id = " . $_SESSION["lang_id"]);
if (mysql_num_rows($db_data->result) > 0)
{
	$row = mysql_fetch_array($db_data->result);
	$db_data->close();
	unset($db_data);
}
else{
	echo "Cannot find data";
	exit();
}
?>

<html>
<head>
<title>Portal Configuration</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? template_top(translate_text("cau_hinh_website"))?>
<div><h1><?=$errorMsg?></h1></div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<form action="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING']?>" method="post" name="setting" enctype="multipart/form-data">
	<tr>
		<td bgcolor="#FFFFFF">
			<? /*---------------------------------*/ ?>
			<table border="0" cellpadding="5" cellspacing="0" width="100%">
				<?
				for($i = 0; $i < count($arrayField); $i++){
				?>
				<tr <? if($i%2==0){?> bgcolor="#E0EAF3" <? }else{?> bgcolor="#DDF8CC" <? }?>>
					<td width="30%" nowrap="nowrap">
					<b><?=$arrayField[$i][4]?> : </b>
					<td>
						<?
						if($arrayField[$i][5]=="text"){?>
						<input type="text" size="<?=$arrayField[$i][3]?>" class="form" name="<?=$arrayField[$i][0]?>" id="<?=$arrayField[$i][0]?>" value="<?=str_replace('"',"&quot;",$row[$arrayField[$i][0]]);?>">
						<?
						}
						?>
						<?
						if($arrayField[$i][5]=="pass"){?>
						<input type="password" size="<?=$arrayField[$i][3]?>" class="form" name="<?=$arrayField[$i][0]?>" id="<?=$arrayField[$i][0]?>" value="<?=$row[$arrayField[$i][0]]?>">
						<?
						}
						?>
						<?
						if($arrayField[$i][5]=="textarea"){?>
						<textarea class="form" name="<?=$arrayField[$i][0]?>" id="<?=$arrayField[$i][0]?>" rows="7" cols="<?=$arrayField[$i][3]?>"><?=$row[$arrayField[$i][0]];?></textarea>
						<?
						}
						?>

					</td>
				</tr>
				<?
				}
				?>
				<? if(file_exists("../../images/logo.png")){ ?>
				<tr bgcolor="#E0EAF3">
					<td width="30%" nowrap="nowrap">
					<b>Hiển thị logo trên ảnh sản phẩm </b>&nbsp;<img src="../../images/logo.png" align="absmiddle" style="border:solid 1px #CCCCCC" border="0"><br>
					<td><input type="checkbox" size="5" class="form" name="con_logoproduct" id="con_logoproduct" value="1" <? if($row["con_logoproduct"]==1) echo "checked"?>></td>
				</tr>
				<? }?>
			</table>
			<? /*---------------------------------*/ ?>
		</td>
	</tr>
	<tr>
		<td align="center" style="padding:7px">
			<input type="button" class="form" value="<?=translate_text("save_change")?>" style="cursor:hand; width:100px" onClick="validateForm();">&nbsp;
			<input type="reset" class="form" value="<?=translate_text("clear_all")?>" style="cursor:hand; width:100px">
			<input type="hidden" name="action" value="update">
		</td>
	</tr>
	</form>
</table>
<? template_bottom() ?>
</body>
</html>