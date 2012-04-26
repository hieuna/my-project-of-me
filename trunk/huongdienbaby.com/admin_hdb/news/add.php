<?
//Created by: Mr Toan
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("add");

//Khai bao Bien
$fs_redirect	= "listing.php?type=list";

//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html

$myform->removeHTML(0);
$approve				= getValue("approve","int","POST",1);
$new_date			= getValue("new_date","str","POST","");
$new_date 			= convertDateTime($new_date,"0:0:0");

//Insert to database
$myform->add("new_category","new_category",1,0,"",1,"Bạn chưa nhập chọn nhóm chuyên mục",0,"Bạn chưa nhập chọn nhóm chuyên mục");
$myform->add("new_title","new_title",0,0,"",1,"Bạn chưa nhập tiêu đề bài viết",0,"Bạn chưa nhập tiêu đề bài viết");
$myform->add("new_date","new_date",0,1,0,1,"Bạn chưa nhập ngày đăng tin",0,"Bạn chưa nhập ngày đăng tin");
$myform->add("new_location","new_location",0,0,"",0,"",0,"");
$myform->add("new_hot","new_hot",1,0,0,0,"",0,"");
$myform->add("new_new","new_new",1,0,0,0,"",0,"");
$myform->add("new_image_note","new_image_note",0,0,"",0,"",0,"");
$myform->add("new_teaser","new_teaser",0,0,"",0,"Bạn chưa có phần tóm tắt cho bài viết",0,"Bạn chưa có phần tóm tắt cho bài viết");
$myform->add("new_description","new_description",0,0,"",0,"",0,"");
//Active data
$myform->add("new_approve","approve",1,1,1,0,"",0,"");
$myform->add("admin_id","admin_id",1,1,0,0,"",0,"");
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "insert"){

	$upload_pic = new upload("picture", $fs_filepath, $extension_list, $limit_size);
	if ($upload_pic->file_name != ""){
		$picture = $upload_pic->file_name;
		resize_image($fs_filepath,$upload_pic->file_name,$small_width,$small_heght,$small_quantity);
		resize_image($fs_filepath,$upload_pic->file_name,$medium_width,$medium_heght,$medium_quantity,"medium_");
		$myform->add("new_picture","picture",0,1,"",0,"",0,"");
	}
	//Check Error!
	$errorMsg .= $upload_pic->show_warning_error();
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex	 = new db_execute_return();
		$last_id = $db_ex->db_execute($myform->generate_insert_SQL());
		//echo $myform->generate_insert_SQL();
		//Add related news
		$new_id = $last_id;
		$relate_id = getValue("arelate_select","arr","POST","");
		if($relate_id != ""){
			for($i=0;$i<count($relate_id);$i++){
				if($new_id != intval($relate_id[$i])){
					$query_str = "INSERT INTO " . $fs_table_relate . " VALUES(" . $new_id . ", " . intval($relate_id[$i]) . ")";
					$db_relate_execute = new db_execute($query_str);
					unset($db_relate_execute);
				}
			}
		}
		//chmod anh vua upload
		
		@chmod($fs_filepath . $picture,0644);
		@chmod($fs_filepath . 'small_' . $picture,0644);
		@chmod($fs_filepath . 'medium_' . $picture,0644);
		
		//Return iCat onChange
		$iCat = getValue("new_category","int","POST");
		// Redirect to add new
		$fs_redirect = "add.php?save=1&iCat=" . $iCat;
		//Redirect to:
		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("add_new");
$myform->evaluate();
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
		if (!confirm("Data has been added to the database ! Do you to add more News?")){
			window.location.href='listing.php';
		}
	</script>
<? } ?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("them_moi_thong_tin"))?>
<? /*---------Body------------*/ ?>
<script language="javascript">
var check_relate=0;
function relate(){
	if(document.getElementById("news_relate_div").style.display=='none'){
		document.getElementById("news_relate_div").style.display='block';
		document.getElementById("icon_relate").src='../images/subtract.gif';
	}else{
		document.getElementById("news_relate_div").style.display='none';
		document.getElementById("icon_relate").src='../images/addition.gif';
	}
}
</script>
<table border="0" cellpadding="3" cellspacing="2" width="70%" align="center">
		<form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'];?>" METHOD="POST" name="add_new" enctype="multipart/form-data">
			<tr>
				<td colspan="2" align="center">
					<?=$errorMsg?>
				</td>
			</tr>
			<tr>
				<td class="textBold" nowrap="nowrap" width="10%" valign="top">
				</td>
				<td valign="top">
					<? /*-----------------*/ ?>
					<table border="0" cellpadding="2" cellspacing="1" width="100%">
						<tr>
							<td class="textBold" nowrap="nowrap" align="right"><?=translate_text("category")?>:</td>
							<td>
								<select name="new_category" id="new_category" class="form">
									<option value="">--[<?=translate_text("select_category")?>]--</option>
									<?
									for($i=0;$i<count($listAll);$i++){
										if($listAll[$i]["cat_id"] == $iCat){
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
							<td>
                     <input type="text" name="new_title" id="new_title" class="form" size="60"  value="<?=$new_title;?>"></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("date")?>:</td>
							<td><input type="text" name="new_date" id="new_date" class="form" size="10" maxlength="10" value="<?=date("d/m/Y");?>"></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("source")?>:</td>
							<td nowrap="nowrap"><input type="text" name="new_location" id="new_location" class="form" size="30" maxlength="50" value="<?=$new_location;?>">&nbsp;<i>(Ex: vnexpress.net)</i></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("check")?>:</td>
							<td><input type="checkbox" name="new_hot" id="new_hot" value="1">&nbsp;<img src="<?=$fs_imagepath?>hot.gif" border="0" width="22" height="10">&nbsp;
							<input type="checkbox" name="new_new" id="new_new" value="1">&nbsp;<img src="<?=$fs_imagepath?>new.gif" border="0" width="33" height="16">
                     <input type="checkbox" name="new_baiviet" id="new_baiviet" value="1">&nbsp;Bài viết
                     </td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("images")?>:</td>
							<td nowrap="nowrap"><input type="file" name="picture" id="picture" class="form" size="30">&nbsp;<i>(Limit size: <font color="#FF0000"><?=number_format($limit_size,0,'','.'); ?></font>&nbsp;kb)</i></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("note_for_image")?>:</td>
							<td><input type="text" name="new_image_note" id="new_image_note" class="form" size="60"  value="<?=$new_image_note;?>"></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("tim_thong_tin_lien_quan")?>:</td>
							<td><input type="text" name="keyword_relate" id="keyword_relate" size="25" class="form" onKeyUp="load_data('select_relate'); return false"> <input type="button" value="<?=translate_text("tim_kiem")?>" onClick="load_data('select_relate');" class="form"></td>
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
																			FROM " . $fs_table . ",categories_multi
																			WHERE cat_id=new_category
																			ORDER BY cat_order ASC,cat_id ASC,new_date DESC
																			LIMIT 20
																			");
											?>
											<select id="list_relate" name="list_relate[]" class="form" multiple="multiple" size="5">
												<?
												$cha_id = 0;
												while($row = mysql_fetch_array($db_room->result)){
												?>
													<option title="<?=$row["new_title"]?>" value="<?=$row["new_id"]?>" >&nbsp; |-- <?=$row["new_title"]?></option>
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
                                <select id="arelate_select" name="arelate_select[]" multiple="multiple" class="form" size="5" style="width:250px"></select><br>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("teaser")?>:</td>
							<td><textarea name="new_teaser" id="new_teaser" style="width:97%; height:120px;" class="form"><?=$new_teaser;?></textarea></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("description")?>:</td>
							<td>
								<?
								$sBasePath	= $_SERVER['PHP_SELF'] ;
								$sBasePath	= "../wysiwyg_editor/" ;						
								$oFCKeditor = new FCKeditor('new_description') ;
								$oFCKeditor->BasePath	= $sBasePath ;
								$oFCKeditor->Value		= "";
								$oFCKeditor->Width = 650;
								$oFCKeditor->Height = 450;
								$oFCKeditor->Create() ;
								?>
							</td>
						</tr>
					</table>
					<? /*-----------------*/ ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="button" class="form" value="<?=translate_text("add_new")?>" style="cursor:hand; width:100px" onClick="selectAll('arelate_select'); validateForm();">&nbsp;
					<input type="reset" class="form" value="<?=translate_text("clear_all")?>" style="cursor:hand; width:100px">
					<input type="hidden" name="approve" value="1">
					<input type="hidden" name="action" value="insert">
				</td>
			</tr>
		</form>
		</table>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<script language="javascript" src="../js/relate.js"></script>
