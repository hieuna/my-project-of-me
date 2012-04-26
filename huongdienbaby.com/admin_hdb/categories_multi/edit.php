<?
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("edit");

require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../functions/functions.php");
require_once("../../classes/upload.php");
require_once("../../classes/menu.php");
require_once("../wysiwyg_editor/fckeditor.php");
//require_once("../../functions/file_functions.php");
//require_once("../../functions/resize_image.php");
//Khai bao Bien
$fs_redirect	= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET");
$field_id		= "cat_id";
//kiểm tra quyền sửa xóa của user xem có được quyền ko
checkRowUser($fs_table,$field_id,$record_id,$fs_redirect);

$cat_type=getValue("cat_type","str","GET","");
if($cat_type=="") $cat_type=getValue("cat_type","str","POST","");
$sql="1";
if($cat_type!="")  $sql="cat_type = '" . $cat_type . "'";
//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);
/*
1. data_field : Ten truong
2. data_value : Ten form
3. data_type : Kieu du lieu , 0 : string , 1 : kieu int, 2 : kieu email, 3 : kieu double
4. data_store : Noi luu giu data  0 : post, 1 : variable
5. data_default_value : gia tri mac dinh, neu require thi` phai lon hon hoac bang default
6. data_require : du lieu nay co can thiet hay khong
7. data_error_message : Loi dua ra man hinh
8. data_unique : Chỉ có duy nhất trong database
9. data_error_message2 : Loi dua ra man hinh neu co duplicate
*/
$active				= getValue("active","int","POST",1);
$cat_name			= getValue("cat_name","str","POST","");
$cat_cha				= getValue("cat_cha","int","POST",1);
$cat_order			= getValue("cat_order","int","POST",0);
if($cat_order==0) $cat_order	= getValue("cat_order","int","GET",0);
$cat_parent_id		= getValue("cat_parent_id","int","POST",0);

$db_edit =new db_query("SELECT * FROM categories_multi WHERE cat_id=" . $record_id);
$row=mysql_fetch_array($db_edit->result);
$sql=" cat_type='" . $row["cat_type"] . "'";
$menu = new menu();
$listAll = $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0",$sql . " AND lang_id = " . $_SESSION["lang_id"] . $sqlcategory,"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_order ASC, cat_name ASC","cat_has_child");
$cat_description = getValue("cat_description","str","POST",$row["cat_description"]);
$cat_thuoctinh = getValue("cat_thuoctinh","int","POST",10);
$cat_teaser = getValue("cat_teaser","str","POST",$row["cat_teaser"]);
$cat_form			= '';
for($i=1;$i<=$cat_thuoctinh;$i++){
	$cat_form .= str_replace("|"," ",getValue("cat_form_" . $i,"str","POST","")) . '|';
}
//Insert to database
$myform->add("cat_parent_id","cat_parent_id",1,0,0,0,"",0,"");
$myform->add("cat_teaser","cat_teaser",0,0,"",0,"",0,"");
$myform->add("cat_description","cat_description",0,0,"",0,"",0,"");
$myform->add("cat_form","cat_form",0,1,"",0,"",0,"");
$myform->add("cat_thuoctinh","cat_thuoctinh",1,0,0,0,"",0,"");
//Active data
$myform->add("cat_active","active",1,1,1,0,"",0,"");
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "insert"){
		/*
	upload function
	upload_name : Ten textbox upload vi du : gal_picture
	upload_path : duong dan save file upload
	extension_list : danh sach cac duoi mo rong duoc phep upload vi du : gif,jpg
	limt_size : dung luong gioi han (tinh bang byte) vi du : 20000 
	*/
	$upload_pic = new upload("picture", $fs_filepath, $extension_list, $limit_size);
	if ($upload_pic->file_name != ""){
		$picture = $upload_pic->file_name;
		//resize_image($fs_filepath,$upload_pic->file_name,100,100,75);
		$myform->add("cat_picture","picture",0,1,"",0,"",0,"");
	}
	//Check Error!
	$errorMsg .= $upload_pic->show_warning_error();
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("cat_id", $record_id));
		if($cat_parent_id > 0){
			$db_ex = new db_execute("UPDATE categories_multi SET cat_has_child = 1 WHERE cat_id = " . $cat_parent_id);
		}
		//echo $myform->generate_insert_SQL();
		//Return iCat onChange
		//Redirect to:
		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("add_new");
//add more javacode
$myform->addjavasrciptcode("
						    		");
$myform->checkjavascript();
?>
<html>
<head>
<title>Add New</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
<?
$save = getValue("save","int","GET",0);
//when data has been save to database
if ($save==1){
?>
	<script language="javascript">
		if (!confirm("Data has been added to the database ! Do you to add more category?")){
			window.location.href='listing.php';
		}
	</script>
<? } ?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<script language="javascript" src="../js/library.js"></script>
<? template_top(translate_text("sua_category") . ": " . $row["cat_name"])?>
		<table border="0" width="100%" cellpadding="4" cellspacing="1">
		<form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING']?>" METHOD="POST" name="add_new" enctype="multipart/form-data">
        	<tr> 
				<td align="right" nowrap class="textBold">Mô tả:</td>
				<td>
					<input type="text" name="cat_teaser" id="cat_teaser" value="<?=$cat_teaser?>" size="50" maxlength="50" class="form">
				</td>
			</tr>
			<tr>
				<td class="textBold" align="right"><?=translate_text("image")?>:</td>
				<td>
					<input type="file" name="picture" id="picture" class="form" size="40">				</td>
			</tr>
			<tr>
				<td align="right" nowrap="nowrap" class="textBold"><?=translate_text("upper_category")?>:</td>
				<td> 
					<select name="cat_parent_id" id="cat_parent_id" class="form">
					<option value="0">--[<?=translate_text("upper_category")?>]--</option>
					<?
					for($i=0;$i<count($listAll);$i++){
						if($listAll[$i]["cat_id"] == $row["cat_parent_id"]){
					?>
						<option value="<?=$listAll[$i]["cat_id"]?>" selected="selected">
						<?
						for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
							echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"];
						?>
						</option>
					<? }else{ ?>
						<option value="<?=$listAll[$i]["cat_id"]?>">
						<?
						for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
							echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"];
						?>
						</option>
					<?
						}
					}
					?>
					</select>				
					</td>
			</tr>
			<? /*
			<tr>
				<td align="right">&nbsp;</td>
				
				<td class="textBold"><?=translate_text("chon_so_thuoc_tinh")?>: 
					<?
					$cat_thuoctinh = getValue("cat_thuoctinh","int","POST",$row["cat_thuoctinh"]);
					?>
					<select  id="cat_thuoctinh" name="cat_thuoctinh" class="form" onChange="changethuoctinh(this.value)">
						<?
						for($i=1;$i<50;$i++){
						?>
							<option value="<?=$i?>" <? if($cat_thuoctinh==$i) echo 'selected';?>><?=$i?></option>
						<?
						}
						?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td nowrap="nowrap" align="right" class="textBold"><?=translate_text("form_product")?>:</td>
				<td>
					<div id="category_thuoctinh" style="overflow:hidden; height:<?=($cat_thuoctinh*30)?>px;">
					<table cellpadding="4" cellspacing="0" border="0">
						<?
						$arrayCatform = explode("|",$row["cat_form"]);
						for($i=1;$i<50;$i++){
						?>
							<tr>
								<td class="textBold" height="30"><?=translate_text("thuoc_tinh")?> <?=$i?>:</td>
								<td><input type="text" name="cat_form_<?=$i?>" id="cat_form_<?=$i?>" value="<?=isset($arrayCatform[$i-1]) ? $arrayCatform[$i-1] : getValue("cat_form_" . $i,"str","POST",'')?>" class="form" style="width:400px;"></td>
							</tr>
						<?
						}
						?>
					</table>
					</div>
				</td>
			</tr>
			*/ ?>
			<tr>
				<td nowrap="nowrap" align="right" class="textBold"><?=translate_text("chinh_sach_bao_hanh")?>:</td>
				<td>
						<?
						$sBasePath	= $_SERVER['PHP_SELF'] ;
						$sBasePath	= "../wysiwyg_editor/" ;						
						$oFCKeditor = new FCKeditor('cat_description') ;
						$oFCKeditor->BasePath	= $sBasePath ;
						$oFCKeditor->Value		= $row["cat_description"];
						$oFCKeditor->Width = 650;
						$oFCKeditor->Height = 450;
						$oFCKeditor->Create() ;
						?>
					</td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="button" class="form" value="<?=translate_text("save_change")?>" style="cursor:hand; width:100px" onClick="validateForm();">&nbsp;
					<input type="reset" class="form" value="<?=translate_text("clear_all")?>" style="cursor:hand; width:100px">
					<input type="hidden" name="active" value="1">
					<input type="hidden" name="action" value="insert">				</td>
			</tr>
		</form>
		</table>
<? template_bottom() ?>
</body>
</html>