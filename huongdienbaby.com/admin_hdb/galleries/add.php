<?
//Created by: Mr Toan
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("add");

//Khai bao Bien
$fs_redirect		= "listing.php?type=list";

//Call Class generate_form();
$myform 				= new generate_form();
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
$approve				= getValue("approve","int","POST",1);
$lang_id				= $_SESSION["lang_id"];
$gal_date			= time();
//Insert to database
$myform->add("gal_category","gal_category",1,0,0,1,"Bạn chưa nhập chọn nhóm chuyên mục",0,"Bạn chưa nhập chọn nhóm chuyên mục");
$myform->add("gal_name","gal_name",0,0,"",1,"Bạn chưa nhập tiêu đề bài viết",0,"Bạn chưa nhập tiêu đề bài viết");
$myform->add("gal_description","gal_description",0,0,"",0,"",0,"");
$myform->add("admin_id","admin_id",1,1,0,0,"",0,"");
//Active data
$myform->add("gal_approve","approve",1,1,1,0,"",0,"");
$myform->add("gal_type","gal_type",1,0,0,0,"",0,"");
$myform->add("gal_hot","gal_hot",1,0,0,0,"",0,"");
$myform->add("gal_new","gal_new",1,0,0,0,"",0,"");
$myform->add("gal_date","gal_date",1,1,0,0,"",0,"");
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
		$myform->add("gal_picture","picture",0,1,"",0,"",0,"");
	}
	//Check Error!
	$errorMsg .= $upload_pic->show_warning_error();
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_insert_SQL());
		//echo $myform->generate_insert_SQL(); exit();
		//Return iCat onChange
		$iCat = 0;
		if (isset($_POST["gal_category"])) $iCat = $_POST["gal_category"];
		// Redirect to add new
		@unlink($fs_filepath . $picture);
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
		if (!confirm("Data has been added to the database ! Do you to add more data?")){
			window.location.href='listing.php';
		}
	</script>
<? } ?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? template_top(translate_text("them_moi_gallery"))?>
		<? /*---------Body------------*/ ?>
		<table border="0" cellpadding="3" cellspacing="2" width="70%" align="center" >
		<form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'];?>" METHOD="POST" name="add_new" enctype="multipart/form-data">
			<tr>
				<td align="center">
					<?=$errorMsg?>
				</td>
			</tr>
				<td valign="top">
					<? /*-----------------*/ ?>
					<table border="0" cellpadding="2" cellspacing="1" width="100%">
						<tr>
							<td class="textBold" nowrap="nowrap" align="right"><?=translate_text("category")?>:</td>
							<td>
								<select name="gal_category" id="gal_category" class="form">
									<option value="">--[<?=translate_text("select_category")?>]--</option>
										<?
										$iCat = getValue("iCat","int","GET",0);
										for($i=0;$i<count($listAll);$i++){
										?>
											<option value="<?=$listAll[$i]["cat_id"]?>" <? if($iCat==$listAll[$i]["cat_id"]) echo 'selected="selected"';?>>
											<?
											for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
												echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"];
											?>
											</option>
									
										<?
										}
										?>
								</select>
							</td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("name")?>:</td>
							<td><input type="text" name="gal_name" id="gal_name" class="form" size="60" maxlength="255" value="<?=$gal_name;?>"></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("image")?>:</td>
							<td><input type="file" name="picture" id="picture" class="form"> <strong><?=translate_text("Kich_thuoc")?>:</strong> <?=$medium_width?>px <strong>X</strong> <?=$medium_heght?>px</td>
						</tr>
						<?
						if(count($arrayType)>0){
						?>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("type")?>:</td>
							<td><?=translate_text("gallery")?>: <input type="radio" name="gal_type" value="1" checked="checked"> <?=translate_text("video")?>: <input type="radio" name="gal_type" value="2"></td>
						</tr>
						<?
						}
						?>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("check")?>:</td>
							<td><?=translate_text("hot")?>: <input type="checkbox" name="gal_hot" id="gal_hot" value="1"> <?=translate_text("new")?>: <input type="checkbox" name="gal_new" id="gal_new" value="1"></td>
						</tr>
						<tr>
							<td class="textBold"><?=translate_text("description")?></td>
							<td class="textBold" nowrap="nowrap">
								<textarea name="gal_description" id="gal_description" class="form" cols="60" rows="10"><?=$gal_description;?></textarea>
							</td>
						</tr>
						<tr>
							<td class="textBold">&nbsp;</td>
							<td class="textBold" nowrap="nowrap">
								<input type="button" class="form" value="<?=translate_text("save_change")?>" style="cursor:hand; width:100px" onClick="validateForm();">&nbsp;
								<input type="reset" class="form" value="<?=translate_text("clear_all")?>" style="cursor:hand; width:100px">
								<input type="hidden" name="approve" value="1">
								<input type="hidden" name="action" value="insert">
							</td>
						</tr>
					</table>
					<? /*-----------------*/ ?>
				</td>
			</tr>
		</form>
		</table>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>