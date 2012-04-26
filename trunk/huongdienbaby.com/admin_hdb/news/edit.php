<?
//Created by: Mr Toan
require_once("config_security.php");

//Khai bao Bien
$url					=	base64_decode(getValue("url","str","GET",base64_encode("listing.php")));
$record_id 			= getValue("record_id", "int", "GET", 0);
//kiem tra quyen co duoc sua xoa hay ko
checkRowUser($fs_table,$field_id,$record_id,$url);

//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);
$new_date		= getValue("new_date","str","POST","");
//Checkdate
$new_date 			= convertDateTime($new_date,"0:0:0");
//Insert to database
$myform->add("new_category","new_category",1,0,"",1,"Bạn chưa nhập chọn nhóm chuyên mục",0,"Bạn chưa nhập chọn nhóm chuyên mục");
$myform->add("new_title","new_title",0,0,"",1,"Bạn chưa nhập tiêu đề bài viết",0,"Bạn chưa nhập tiêu đề bài viết");
$myform->add("new_date","new_date",0,1,0,1,"Bạn chưa nhập ngày đăng tin",0,"Bạn chưa nhập ngày đăng tin");
$myform->add("new_location","new_location",0,0,"",0,"",0,"");
$myform->add("new_hot","new_hot",1,0,0,0,"",0,"");
$myform->add("new_new","new_new",1,0,0,0,"",0,"");
$myform->add("new_approve","new_approve",1,0,0,0,"",0,"");
$myform->add("new_image_note","new_image_note",0,0,"",0,"",0,"");
$myform->add("new_teaser","new_teaser",0,0,"",0,"Bạn chưa có phần tóm tắt cho bài viết",0,"Bạn chưa có phần tóm tắt cho bài viết");
$myform->add("new_description","new_description",0,0,"",0,"",0,"");
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
	upload_name : Ten textbox upload vi du : new_picture
	upload_path : duong dan save file upload
	extension_list : danh sach cac duoi mo rong duoc phep upload vi du : gif,jpg
	limt_size : dung luong gioi han (tinh bang byte) vi du : 20000 
	*/
	$upload_pic = new upload("picture", $fs_filepath, $extension_list, $limit_size);
	if ($upload_pic->file_name != ""){
		$picture = $upload_pic->file_name;
		resize_image($fs_filepath,$upload_pic->file_name,$small_width,$small_heght,$small_quantity);
		resize_image($fs_filepath,$upload_pic->file_name,$medium_width,$medium_heght,$medium_quantity,"medium_");
		$myform->add("new_picture","picture",0,1,"",0,"",0,"");
	}
	//Delete picture
	if ($upload_pic->file_name != ""){
		//Delete file
		delete_file($fs_table,"new_id",$record_id,"new_picture",$fs_filepath);
		//Permision file
		chmod_file_update($fs_table,"new_id",$record_id,"new_picture",$fs_filepath);
		/*echo "<script>alert('\$record_id = " . $record_id . "')</script>";*/
	}
	//Check Error!
	$errorMsg .= $upload_pic->show_warning_error();
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_update_SQL("new_id", $record_id));
		//echo $myform->generate_update_SQL("new_id", $record_id);
		//Add related news
		$relate_id = getValue("arelate_select","arr","POST","");
		//Xoa tat ca cac ID dang ton tai
		//Thay doi cac ID moi
		$query_del_data = "DELETE FROM " . $fs_table_relate . " WHERE rel_id = " . $record_id;
		$db_del_data = new db_execute($query_del_data);
		if($relate_id != ""){
			for($i=0;$i<count($relate_id);$i++){
				if($record_id != intval($relate_id[$i])){
					$query_str = "REPLACE INTO " . $fs_table_relate . " VALUES(" . $record_id . ", " . intval($relate_id[$i]) . ")";
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
$myform->evaluate();
$myform->checkjavascript();
//Select data
$db_data = new db_query("SELECT *
						 FROM news
						 WHERE  new_id = " . $record_id);
if (mysql_num_rows($db_data->result) == 0){
	echo "Cannot find data";
	exit();
}
?>
<html>
<head>
<title>Add New</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("sua_doi_thong_tin"))?>
<?
if($row=mysql_fetch_array($db_data->result)){
?>
		<? /*---------Body------------*/ ?>
		<table border="0" cellpadding="3" cellspacing="2" width="70%" align="center">
		<form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'];?>" METHOD="POST" name="edit_data" enctype="multipart/form-data">
			<tr>
				<td colspan="2" align="center">
					<?=$errorMsg?>
				</td>
			</tr>
			<tr>
				<td class="textBold" nowrap="nowrap" width="10%" valign="top">&nbsp;
				
				</td>
				<td valign="top">
					<? /*-----------------*/ ?>
					<table border="0" cellpadding="2" cellspacing="1" width="100%">
						<tr>
							<td class="textBold" nowrap="nowrap" align="right">CATEGORIES:</td>
							<td>
								<select name="new_category" id="new_category" class="form">
									<option value="">--[Select one category]--</option>
											<?
											$iParent = getValue("iCat","int","GET",0);
											for($i=0;$i<count($listAll);$i++){
												if($listAll[$i]["cat_id"] == $row["new_category"]){
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
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("title")?>:</td>
							<td><input type="text" name="new_title" id="new_title" class="form" size="60" maxlength="100" value="<?=htmlspecialchars($row["new_title"]);?>"></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("date")?>:</td>
							<td><input type="text" name="new_date" id="new_date" class="form" size="10" maxlength="10" value="<?=getShortDate($row["new_date"]);?>"></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("source")?>:</td>
							<td nowrap="nowrap"><input type="text" name="new_location" id="new_location" class="form" size="30" maxlength="50" value="<?=$row["new_location"];?>">&nbsp;<i>(Ex: vnexpress.net)</i></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("check")?>:</td>
							<td><input type="checkbox" name="new_hot" id="new_hot" <? if($row["new_hot"] == 1) echo "checked"; ?> value="1">&nbsp;<img src="<?=$fs_imagepath?>hot.gif" border="0" width="22" height="10">&nbsp;
							<input type="checkbox" name="new_new" id="new_new" <? if($row["new_new"] == 1) echo "checked"; ?> value="1">&nbsp;<img src="<?=$fs_imagepath?>new.gif" border="0" width="33" height="16">&nbsp;
							<input type="checkbox" name="new_approve" id="new_approve" <? if($row["new_approve"] == 1) echo "checked"; ?> value="1">&nbsp;<img src="<?=$fs_imagepath?>active.gif" border="0" width="16" height="17" title="Data Active"></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("image")?>:</td>
							<td nowrap="nowrap"><input type="file" name="picture" id="picture" class="form" size="30">&nbsp;<i>(Limit size: <font color="#FF0000"><?=number_format($limit_size,0,'','.'); ?></font>&nbsp;bytes)</i></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("note_for_image")?>:</td>
							<td><input type="text" name="new_image_note" id="new_image_note" class="form" size="60" maxlength="100" value="<?=$row["new_image_note"];?>"></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("tim_thong_tin_lien_quan")?>:</td>
							<td><input type="text" name="keyword_relate" id="keyword_relate" size="25" class="form" onKeyUp="load_data('select_relate'); return false"> <input type="button" value="Tìm kiếm" onClick="load_data('select_relate');" class="form"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
								<table cellpadding="2" cellspacing="0">
									<tr>
										<td class="textBold"><?=translate_text("chon_thong_tin")?></td>
										<td>&nbsp;</td>
										<td class="textBold"><?=translate_text("thong_tin_lien_quan")?></td>
									</tr>
									<tr>
										<td valign="top">
											<div id="select_relate" style=" background:#FFFFFF;">
											<?
											$db_room=new db_query("SELECT * 
																			FROM news,categories_multi
																			WHERE cat_id=new_category
																			ORDER BY new_date DESC
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
                              <select id="arelate_select" name="arelate_select[]" multiple="multiple" class="form" size="5" style="width:250px">
										  	<?
												$db_relatedata=new db_query("SELECT new_title,new_id 
																						FROM news," . $fs_table_relate . "
																						WHERE new_id=rel_id
																						GROUP BY new_id
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
					</table>
					<? /*-----------------*/ ?>
				</td>
			</tr>
			<tr>
				<td class="textBold" nowrap="nowrap" align="center" colspan="2">
					<fieldset>
						<legend><?=translate_text("teaser")?></legend>
						<textarea name="new_teaser" id="new_teaser" cols="125" rows="8" class="form"><?=$row["new_teaser"];?></textarea>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td class="textBold" nowrap="nowrap" align="center" colspan="2">
					<fieldset>
						<legend><?=translate_text("description")?></legend>
						<?
						$sBasePath = $_SERVER['PHP_SELF'] ;
						$sBasePath = "../wysiwyg_editor/" ;
						$oFCKeditor = new FCKeditor('new_description') ;
						$oFCKeditor->BasePath	= $sBasePath ;
						$oFCKeditor->Value		= $row["new_description"];
						$oFCKeditor->Width = 650;
						$oFCKeditor->Height = 450;
						$oFCKeditor->Create() ;
						?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="button" class="form" value="UPDATE DATA" style="cursor:hand; width:100px" onClick="selectAll('arelate_select'); validateForm();">&nbsp;
					<input type="reset" class="form" value="RESET ALL" style="cursor:hand; width:100px">
					<input type="hidden" name="record_id" value="<?=$record_id;?>">
					<input type="hidden" name="action" value="update">
				</td>
			</tr>
		</form>
		</table>
<?
}
?>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<script language="javascript" src="../js/relate.js"></script>