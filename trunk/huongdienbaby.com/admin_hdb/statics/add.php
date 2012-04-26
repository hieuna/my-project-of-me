<?
//Created by: Mr Toan
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("add");

require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../functions/functions.php");
require_once("../wysiwyg_editor/fckeditor.php");
//Khai bao Bien
$fs_redirect	= "listing.php?type=list";

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
$approve		= getValue("approve","int","POST",1);
$sta_category	= getValue("sta_category","int","POST",0);
$sta_title		= getValue("sta_title","str","POST","");
$sta_description= getValue("sta_description","str","POST","");
$lang_id				= $_SESSION["lang_id"];
//Insert to database
$myform->add("sta_category","sta_category",1,0,0,1,"Bạn chưa nhập chọn nhóm chuyên mục",0,"Bạn chưa nhập chọn nhóm chuyên mục");
$myform->add("sta_title","sta_title",0,0,"",1,"Bạn chưa nhập tiêu đề bài viết",0,"Bạn chưa nhập tiêu đề bài viết");
$myform->add("sta_description","sta_description",0,0,"",0,"",0,"");
$myform->add("admin_id","admin_id",1,1,0,0,"",0,"");
//Active data
$myform->add("sta_approve","approve",1,1,1,0,"",0,"");
//Add table
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "insert"){
	//Check Error!
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex = new db_execute($myform->generate_insert_SQL());
		//echo $myform->generate_insert_SQL(); exit();
		//Return iCat onChange
		$iCat = 0;
		if (isset($_POST["sta_category"])) $iCat = $_POST["sta_category"];
		// Redirect to add new
		$fs_redirect = "add.php?save=1&iCat=" . $iCat;
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
		if (!confirm("Data has been added to the database ! Do you to add more data?")){
			window.location.href='listing.php';
		}
	</script>
<? } ?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? template_top(translate_text("them_moi_static"))?>
		<? /*---------Body------------*/ ?>
		<table border="0" cellpadding="3" cellspacing="2" width="70%" align="center" >
		<form ACTION="<?=$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'];?>" METHOD="POST" name="add_new">
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
								<select name="sta_category" id="sta_category" class="form">
									<option value="">--[<?=translate_text("select_category")?>]--</option>
									<?
									$iCat	 = getValue("iCat","int","GET",0);
									$db_cate = new db_query("SELECT cat_id,cat_name
																		FROM categories_multi 
																		WHERE categories_multi.lang_id = " . $_SESSION["lang_id"] . $sqlcategory . " AND cat_type = 'STATIC'
																		ORDER BY cat_order ASC");
									$cha_id = 0;
									while ($row_cats = mysql_fetch_array($db_cate->result)) {
									//get number of record
									$db_counts = new db_query("SELECT count(*) as sta_count FROM " . $fs_table ." WHERE lang_id = " . $_SESSION["lang_id"] . " AND sta_category = " . $row_cats["cat_id"]);
									$row_temps = mysql_fetch_array($db_counts->result);
									unset($db_counts);
									
											if($row_cats["cat_id"] == $iCat){
												echo "<option value='" . $row_cats["cat_id"] . "' selected>&nbsp;&nbsp;&nbsp;|--&nbsp;" . $row_cats["cat_name"] . "&nbsp;(" . $row_temps["sta_count"] . ")" . "</option>";
											}
											else{
												echo "<option value='" . $row_cats["cat_id"] . "'>&nbsp;&nbsp;&nbsp;|--&nbsp;" . $row_cats["cat_name"] . "&nbsp;(" . $row_temps["sta_count"] . "&nbsp;Record)" . "</option>";
											}
									}
									unset($db_cate);
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("title")?>:</td>
							<td><input type="text" name="sta_title" id="sta_title" class="form" size="60" maxlength="100" value="<?=$sta_title;?>"></td>
						</tr>
					</table>
					<? /*-----------------*/ ?>
				</td>
			</tr>
			<tr>
				<td class="textBold" nowrap="nowrap">
					<?=translate_text("description")?>
				</td>
			</tr>
			<tr>
				<td class="textBold" nowrap="nowrap" align="center">
						<?
						$sBasePath	= $_SERVER['PHP_SELF'] ;
						$sBasePath	= "../wysiwyg_editor/" ;						
						$oFCKeditor = new FCKeditor('sta_description') ;
						$oFCKeditor->BasePath	= $sBasePath ;
						$oFCKeditor->Value		= "";
						$oFCKeditor->Width = 650;
						$oFCKeditor->Height = 450;
						$oFCKeditor->Create() ;
						?>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="button" class="form" value="<?=translate_text("save_change")?>" style="cursor:hand; width:100px" onClick="validateForm();">&nbsp;
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