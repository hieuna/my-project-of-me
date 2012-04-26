<?
//Created by: Mr Toan
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("add");

require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../functions/functions.php");
//Khai bao Bien
$fs_redirect	= "listing.php?type=list";

//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);

$approve			= getValue("approve","int","POST",1);
$lang_id				= $_SESSION["lang_id"];
//Insert to database
$myform->add("faq_category","faq_category",1,0,0,1,"Bạn chưa nhập chọn nhóm chuyên mục",0,"");
$myform->add("faq_name","faq_name",0,0,"",0,"Bạn chưa nhập tên",0,"");
$myform->add("faq_email","faq_email",2,0,"",0,"Địa chỉ email không chính xác",0,"");
$myform->add("faq_question","faq_question",0,0,"",0,"",0,"");
$myform->add("faq_answer","faq_answer",0,0,"",0,"",0,"");
$myform->add("admin_id","admin_id",1,1,0,0,"",0,"");
//Active data
$myform->add("faq_approve","approve",1,1,1,0,"",0,"");
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
		//echo $myform->generate_insert_SQL();
		//Return iCat onChange
		$iCat = 0;
		if (isset($_POST["faq_category"])) $iCat = $_POST["faq_category"];
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
<? template_top(translate_text("them_moi_hoi_dap"))?>
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
								<select name="faq_category" id="faq_category" class="form">
									<option value="">--[<?=translate_text("select_category")?>]--</option>
									<?
									$iCat	 = getValue("iCat","int","GET",0);
									$db_cate = new db_query("SELECT cat_id,cat_name
																		FROM categories_multi 
																		WHERE categories_multi.lang_id = " . $_SESSION["lang_id"] . $sqlcategory . " AND cat_type = 'faq'
																		ORDER BY cat_order ASC");
									$cha_id = 0;
									while ($row_cats = mysql_fetch_array($db_cate->result)) {
									//get number of record
									$db_counts = new db_query("SELECT count(*) as faq_count FROM " . $fs_table ." WHERE lang_id = " . $_SESSION["lang_id"] . " AND faq_category = " . $row_cats["cat_id"]);
									$row_temps = mysql_fetch_array($db_counts->result);
									unset($db_counts);
									
											if($row_cats["cat_id"] == $iCat){
												echo "<option value='" . $row_cats["cat_id"] . "' selected>&nbsp;&nbsp;&nbsp;|--&nbsp;" . $row_cats["cat_name"] . "&nbsp;(" . $row_temps["faq_count"] . ")" . "</option>";
											}
											else{
												echo "<option value='" . $row_cats["cat_id"] . "'>&nbsp;&nbsp;&nbsp;|--&nbsp;" . $row_cats["cat_name"] . "&nbsp;(" . $row_temps["faq_count"] . "&nbsp;Record)" . "</option>";
											}
									}
									unset($db_cate);
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("full_name")?>:</td>
							<td><input type="text" name="faq_name" id="faq_name" class="form" size="60" maxlength="100" value="<?=$faq_name;?>"></td>
						</tr>
						<tr>
							<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("email")?>:</td>
							<td><input type="text" name="faq_email" id="faq_email" class="form" size="60" maxlength="100" value="<?=$faq_email;?>"></td>
						</tr>
						<tr>
							<td class="textBold"><?=translate_text("question")?></td>
							<td class="textBold" nowrap="nowrap">
								<textarea name="faq_question" id="faq_question" class="form" cols="60" rows="10"><?=$faq_question;?></textarea>
							</td>
						</tr>
						<tr>
							<td class="textBold"><?=translate_text("answer")?></td>
							<td class="textBold" nowrap="nowrap">
								<textarea name="faq_answer" id="faq_answer" class="form" cols="60" rows="10"><?=$faq_answer;?></textarea>
							</td>
						</tr>
					</table>
					<? /*-----------------*/ ?>
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