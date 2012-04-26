<?
//Created by: Mr Toan
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("edit");

require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../classes/upload.php");
require_once("../../functions/functions.php");
require_once("../../functions/file_functions.php");
require_once("../../functions/resize_image.php");
require_once("../../functions/date_function.php");
require_once("../wysiwyg_editor/fckeditor.php");
require_once("../../functions/functions_form.php");
$record_id	 = getValue("record_id","int","GET",0);

//Khai bao Bien
$url=base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id		= getValue("record_id","int","GET",0);
//Khai bao Bien
$fs_redirect	= $url;
$record_id		= getValue("record_id","int","GET");
$field_id		= "pro_id";
//kiểm tra quyền sửa xóa của user xem có được quyền ko
checkRowUser($fs_table,$field_id,$record_id,$fs_redirect);

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
$pro_category	= getValue("pro_category","int","POST",$record_id);
$pro_name		= getValue("pro_name","str","POST","");
$pro_date		= getValue("pro_date","str","POST","");
//Checkdate
$pro_date 				= convertDateTime($pro_date,"0:0:0");
$pro_hot					= getValue("pro_hot","int","POST",0);
$pro_new					= getValue("pro_new","int","POST",0);
$pro_active				= getValue("pro_active","int","POST",0);
$pro_teaser				= getValue("pro_teaser","str","POST","");
$pro_description		= getValue("pro_description","str","POST","");
$size					= getValue("size","arr","POST","");
$pro_size			= 0;
// du lieu cho truong tim kien
$textsearch	= '';
$cat_form	= '';
$db_catname=new db_query("SELECT cat_name,cat_form FROM categories_multi,products WHERE cat_id = pro_category AND pro_id=" . $pro_category);
if($rowcat=mysql_fetch_array($db_catname->result)){
	$textsearch		= $rowcat["cat_name"];
	$cat_form		= $rowcat["cat_form"];
}

$arrcat_form = explode("|",$cat_form);
//print_r($arrcat_form );
$pro_description = '';
$description = '';
$i=0;
foreach($arrcat_form as $key=>$value){
	$i++;
	$pro_description .= str_replace("|"," ",getValue("pro_des_" . $i,"str","POST","")) . '|';
	$description		.= $value . ' ' . str_replace("|"," ",getValue("pro_des_" . $i,"str","POST","")) . ' ';
}

$db_catname->close();
unset($db_catname);

//Insert to database
//$myform->add("pro_category","pro_category",1,0,0,1,"Ban chua chon danh muc",0,"Bạn chưa nhập chọn nhóm chuyên mục");
//$myform->add("pro_supplier","pro_supplier",1,0,0,1,"Ban chua chon hang san xuat",0,"Bạn chưa nhập chọn nhóm chuyên mục");
$myform->add("pro_name","pro_name",0,0,"",1,"Bạn chưa nhập tiêu đề bài viết",0,"Bạn chưa nhập tiêu đề bài viết");
$myform->add("pro_date","pro_date",0,1,0,1,"Bạn chưa nhập ngày đăng tin",0,"Bạn chưa nhập ngày đăng tin");
$myform->add("pro_hot","pro_hot",1,0,0,0,"",0,"");
$myform->add("pro_new","pro_new",1,0,0,0,"",0,"");
$myform->add("pro_sp_khuyenmai","pro_sp_khuyenmai",1,0,0,0,"",0,"");
$myform->add("pro_active","pro_active",1,0,0,0,"",0,"");
$myform->add("pro_description","pro_description",0,1,"",0,"",0,"");
$myform->add("pro_description2","pro_description2",0,0,"",0,"",0,"");
$myform->add("pro_teaser","pro_teaser",0,0,"",0,"",0,"");
//array này gồm key là nội dung ; value 1 là lấy từ biến, 0 là lấy từ post
$myform->add_Field_Seach("pro_search",array("pro_name"=>0,"pro_teaser"=>0,"description"=>1,"textsearch"=>1));

//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "update"){
	$record_id = getValue("record_id", "int", "POST", 0);
	/*
	upload function
	upload_name : Ten textbox upload vi du : pro_picture
	upload_path : duong dan save file upload
	extension_list : danh sach cac duoi mo rong duoc phep upload vi du : gif,jpg
	limt_size : dung luong gioi han (tinh bang byte) vi du : 20000 
	*/
	$upload_pic = new upload("picture", $fs_filepath, $extension_list, $limit_size);
	if ($upload_pic->file_name != ""){
		$picture = $upload_pic->file_name;
		resize_image($fs_filepath,$upload_pic->file_name,$medium_width,$medium_heght,$medium_quantity,"medium_");
		resize_image($fs_filepath,$upload_pic->file_name,$small_width,$small_heght,$small_quantity,"small_");
		$myform->add("pro_picture","picture",0,1,"",0,"",0,"");
		//chmod images
		@chmod($fs_filepath . $picture,0644);
		@chmod($fs_filepath . 'small_' . $picture,0644);
		@chmod($fs_filepath . 'medium_' . $picture,0644);
	}
	//Delete picture
	if ($upload_pic->file_name != ""){
		//Delete file
		delete_file($fs_table,"pro_id",$record_id,"pro_picture",$fs_filepath);
		//Permision file
		chmod_file_update($fs_table,"pro_id",$record_id,"pro_picture",$fs_filepath);
		/*echo "<script>alert('\$record_id = " . $record_id . "')</script>";*/
	}
	//Check Error!
	$errorMsg .= $upload_pic->show_warning_error();
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("pro_id", $record_id));
		//echo $myform->generate_update_SQL("pro_id", $record_id);
		//Add related products
		$relate_id = getValue("arelate_select","arr","POST","");
		//Xoa tat ca cac ID dang ton tai
		//Thay doi cac ID moi
		$query_del_data = "DELETE FROM products_relate WHERE id_record = " . $record_id;
		$db_del_data = new db_execute($query_del_data);
		if($relate_id != ""){
			for($i=0;$i<count($relate_id);$i++){
				if(intval($relate_id[$i])!=$record_id){
					$query_str = "REPLACE INTO products_relate VALUES(" . $record_id . "," . intval($relate_id[$i]) . ")";
					//echo $query_str . "<br>";
					$db_relate_execute = new db_execute($query_str);
					unset($db_relate_execute);
				}
			}
		}
		//Redirect to:
		redirect($url);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("edit_data");
//add more javacode
$myform->addjavasrciptcode("");
$myform->checkjavascript();
//Select data
$db_data = new db_query("SELECT *
						 FROM categories_multi, products
						 WHERE cat_id = pro_category AND pro_id = " . $record_id);
if (mysql_num_rows($db_data->result) == 0){
	echo "Cannot find data";
	exit();
}
?>
<html>
<head>
<title>Add New</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="<?=$fs_stype_css?>" rel="stylesheet" type="text/css"> 
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?
if($row=mysql_fetch_array($db_data->result)){
?>
<? template_top(translate_text("sua_product") . ": " . $row["pro_name"])?>
		<form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'];?>" METHOD="POST" name="edit_data" enctype="multipart/form-data">
		<? /*---------Body------------*/ ?>
		<table border="0" cellpadding="3" cellspacing="2" width="70%" align="center">
				<tr>
				<td colspan="2" align="center">
					<?=$errorMsg?>
				</td>
			</tr>
			<? /*?>
			<tr>
				<td class="textBold" nowrap="nowrap" align="right"><?=translate_text("hang_san_xuat")?>:</td>
				<td>
					<select name="pro_supplier" id="pro_supplier" class="form">
						<option value="">--[<?=translate_text("chon_hang_san_xuat")?>]--</option>
						<?
						foreach($arraySupplier as $key=>$value){
						?>
							<option value="<?=$key?>" <? if($row["pro_supplier"]==$key) echo 'selected';?>><?=$value?></option>
						<?
						}
						?>
					</select>
				</td>
			</tr>
			<? */?>
			<?
			form("pro_name",1,$row["pro_name"],translate_text("title"),60);
			form("pro_price",1,$row["pro_price"],translate_text("price"),10);
			form("pro_date",1,getShortDate($row["pro_date"]),translate_text("date"),10);
			?>
			<tr>
				<td class="textBold" nowrap="nowrap" align="right" width="10%">CHECK:</td>
				<td><input type="checkbox" name="pro_hot" id="pro_hot" <? if($row["pro_hot"] == 1) echo "checked"; ?> value="1">&nbsp;<img src="<?=$fs_imagepath?>hot.gif" border="0" width="22" height="10">&nbsp;
				<input type="checkbox" name="pro_new" id="pro_new" <? if($row["pro_new"] == 1) echo "checked"; ?> value="1">&nbsp;<img src="<?=$fs_imagepath?>new.gif" border="0" width="33" height="16">&nbsp;
				<input type="checkbox" name="pro_active" id="pro_active" <? if($row["pro_active"] == 1) echo "checked"; ?> value="1">&nbsp;<img src="<?=$fs_imagepath?>active.gif" border="0" width="16" height="17" title="Data Active">
				<input type="checkbox" name="pro_sp_khuyenmai" id="pro_sp_khuyenmai" <? if($row["pro_sp_khuyenmai"] == 1) echo "checked"; ?> value="1">&nbsp;Danh sách khuyến mại</td>
			</tr>
			<tr>
				<td class="textBold" nowrap="nowrap" align="right" width="10%">IMAGE:</td>
				<td nowrap="nowrap"><input type="file" name="picture" id="picture" class="form" size="30">&nbsp;<i>(Limit size: <font color="#FF0000"><?=number_format($limit_size,0,'','.'); ?></font>&nbsp;bytes)</i></td>
			</tr>
			<?
			/*
			?>
			<tr>
				<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("tim_san_pham_lien_quan")?>:</td>
				<td><input type="text" name="keyword_relate" id="keyword_relate" size="25" class="form" onKeyUp="load_data('select_relate'); return false"> <input type="button" value="Tìm kiếm" onClick="load_data('select_relate');" class="form"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<table cellpadding="2" cellspacing="0">
						<tr>
							<td class="textBold"><?=translate_text("chon_san_pham")?></td>
							<td>&nbsp;</td>
							<td class="textBold"><?=translate_text("san_pham_lien_quan")?></td>
						</tr>
						<tr>
							<td valign="top">
								<div id="select_relate" style=" background:#FFFFFF;">
								<?
								$db_room=new db_query("SELECT * 
																FROM news,categories_multi
																WHERE cat_id=new_category " . $sqlcategory . "
																ORDER BY cat_order ASC,cat_id ASC,new_date DESC
																LIMIT 20
																");
								?>
								<select id="list_relate" name="list_relate[]" class="form" multiple="multiple" size="5">
									<?
									$cha_id = 0;
									while($rowl = mysql_fetch_array($db_room->result)){
									?>
										<?
										if($cha_id != $rowl["cat_id"]){
											$cha_id	= $rowl["cat_id"];
										?>
										<optgroup label="<?=$rowl["cat_name"]?>"></optgroup>
										<?
										}
										?>
										<option title="<?=$rowl["new_title"]?>" value="<?=$rowl["new_id"]?>" >&nbsp; |-- <?=$rowl["new_title"]?></option>
									<?
									}
									?>
								  </select>
								  </div>
							</td>
							<td>
								<input type="button" style="color:#FF0000; font-weight:bold;" value=">" onClick="appendOption('list_relate','arelate_select')" class="form"><br>
								<input type="button" style="color:#FF0000; font-weight:bold;" value="<" onClick="appendOption('arelate_select','list_relate')"  class="form">
							</td>
							<td valign="top">
							  <select id="arelate_select" name="arelate_select[]" multiple="multiple" class="form" size="5" style="width:350px">
								<?
									$db_relatedata=new db_query("SELECT new_title,new_id 
																			FROM news,products_relate
																			WHERE new_id=id_relate AND id_record=" . $row["pro_id"] . "
																			ORDER BY new_date DESC
																			");
								?>
									<?
									while($rowr=mysql_fetch_array($db_relatedata->result)){
									?>
										<option value="<?=$rowr["new_id"]?>"><?=$rowr["new_title"]?></option>
									<?
									}
									?>
							  </select>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<?
			//*/
			?>
			<?
			form("pro_teaser",2,$row["pro_teaser"],translate_text("teaser"),70,7);
			//
			?>
			<tr>
				<td colspan="2">
					<table cellpadding="3" cellspacing="2">
						<?
						$i=0;
						$arrayDescrip = explode("|",$row["pro_description"]);
						foreach($arrcat_form as $key=>$value){
							$i++;
							if(trim($value)!=''){
							$valuedata = isset($arrayDescrip[$i-1]) ? $arrayDescrip[$i-1] : '';
								if(strpos($valuedata,chr(13)) !== false){
								?>
									<tr>
										<td class="textBold" align="right"><?=$value?></td>
										<td><span id="span_<?=$i?>"><textarea name="pro_des_<?=$i?>" id="pro_des_<?=$i?>" rows="6"  class="form" style="width:400px;"><?=isset($arrayDescrip[$i-1]) ? $arrayDescrip[$i-1] : ''?></textarea></span><img src="../images/0.png" style="cursor:pointer" onClick="changeTypeForm(<?=$i?>)" id="image_<?=$i?>" align="absmiddle" border="0"></td>
									</tr>
								<?
								}else{
								?>
									<tr>
										<td class="textBold" align="right"><?=$value?></td>
										<td><span id="span_<?=$i?>"><input type="text" name="pro_des_<?=$i?>" id="pro_des_<?=$i?>" value="<?=isset($arrayDescrip[$i-1]) ? $arrayDescrip[$i-1] : ''?>" class="form" style="width:400px;"></span><img src="../images/1.png" style="cursor:pointer" onClick="changeTypeForm(<?=$i?>)" id="image_<?=$i?>" align="absmiddle" border="0"></td>
									</tr>
								<?
								}
							}
						}
						?>
					</table>
				</td>
			</tr>
			<? form("pro_description2",7,$row["pro_description2"],translate_text("description"),650,450); ?>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="button" class="form" value="UPDATE DATA" style="cursor:hand; width:100px" onClick=" validateForm();">&nbsp;
					<input type="reset" class="form" value="RESET ALL" style="cursor:hand; width:100px">
					<input type="hidden" name="record_id" value="<?=$record_id;?>">
					<input type="hidden" name="action" value="update">
				</td>
			</tr>
		</table>
		</form>
<? template_bottom() ?>
<?
}
?>
		<? /*---------Body------------*/ ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<script language="javascript" src="../js/relate.js"></script>
<script language="javascript" src="../js/library.js"></script>
