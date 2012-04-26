<?
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("add");

require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../functions/functions.php"); 
$ff_action = getURL();
$ff_redirect_succ = "listing.php";
$ff_redirect_fail = "";

$ff_table = "admin_user";

$Action = getValue("Action","str","POST","");
$errorMsg = "";
$allow_insert = 1;
if ($Action =='insert')
{
	//get vaule from POST
	$adm_loginname = getValue("adm_loginname","str","POST","",1);
	//password hash md5 --> only replace \' = '
	$adm_password = getValue("adm_password","str","POST","",1);
	//get Access Module list
	$module_list			= "";
	$module_list  			= getValue("mod_id","arr","POST","");
	$user_lang_id_list  	= getValue("user_lang_id","arr","POST","");
	$arelate_select  		= getValue("arelate_select","arr","POST","");
	if ($module_list ==""){
		$allow_insert = 0;
		$errorMsg .= "Bạn chưa chọn module nào ! <br>";
	}
	
	//insert new user to database
	if ($allow_insert == 1){
		//Call Class generate_form();
		$myform = new generate_form();
		$myform->add("adm_loginname","adm_loginname",0,0,"   ",1," Tên đăng nhập ko được để trống va > 2 ky tu",1," Tài khoản quản trị đã tồn tại");
		$myform->add("adm_password","adm_password",4,0,"    ",1,"Mật khẩu phải lớn hơn 4 ký tự",0,"");
		$myform->add("adm_email","adm_email",2,0,"",1," Email không chính xác !",0,"");
		$myform->add("adm_all_category","adm_all_category",1,0,0,0,"",0,"");
		$myform->add("adm_edit_all","adm_edit_all",1,0,0,0,"",0,"");
		$myform->add("admin_id","admin_id",1,1,0,0,"",0,"");
		$myform->addTable("admin_user");
		$querystr = $myform->generate_insert_SQL();
		$errorMsg .= $myform->checkdata();
		$last_id = 0;
		if($errorMsg == ""){
			$db_ex = new db_execute_return();
			$last_id = $db_ex->db_execute($querystr);
			unset($db_ex);
			if($last_id!=0){
				//insert user right\
				if(isset($module_list[0])){
					for ($i=0; $i< count($module_list); $i++){
						$query_str = "INSERT INTO admin_user_right VALUES(" . $last_id . "," . $module_list[$i] . ", " . getValue("adu_add" . $module_list[$i] , "int","POST") . ", " . getValue("adu_edit" . $module_list[$i] , "int","POST") . ", " . getValue("adu_delete" . $module_list[$i] , "int","POST") . ")";
						$db_ex = new db_execute($query_str);
						unset($db_ex);
					}
				}
				if(isset($user_lang_id_list[0])){
					for ($i=0; $i< count($user_lang_id_list); $i++){
						$query_str = "INSERT INTO admin_user_language VALUES(" . $last_id . "," . $user_lang_id_list[$i] .")";
						$db_ex = new db_execute($query_str);
						unset($db_ex);
					}
				}
				//category right
				$arelate_select  		= getValue("arelate_select","arr","POST","");
				if(isset($arelate_select[0])){
					for ($i=0; $i<count($arelate_select); $i++){
						$query_str = "INSERT INTO admin_user_category VALUES(" . $last_id . "," . $arelate_select[$i] .")";
						echo $query_str . '<br>';
						$db_ex = new db_execute($query_str);
						unset($db_ex);
					}
				}
			redirect($ff_redirect_succ);
			exit();
			}
		}
	}
}
$db_getallmodule = new db_query("SELECT * 
								FROM modules
								ORDER BY mod_order DESC");
?>
<html>
<head>
<title>Add New</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css">

</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("them_moi_user_admin"))?>
		<? /*---------Body------------*/ ?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgTable">
			<tr> 
			<form ACTION="<?=$ff_action;?>" METHOD="POST" name="add_user" enctype="multipart/form-data">
			<td>
			<table align="center" cellpadding="4" cellspacing="1">
			<tr valign="baseline"> 
			<td class="textBold" colspan="2" align="center">
			<font color="#FF0000"><?=$errorMsg;?></font>
			</td>
			</tr>
			<tr <?=$fs_change_bg?>> 
			<td align="right" valign="middle" nowrap class="textBold"><?=translate_text("ten_dang_nhap")?>:</td>
			<td class="textBold">
			<input type="text" name="adm_loginname" size="50" maxlength="50" class="form"> 
			</td>
			</tr>
			<tr <?=$fs_change_bg?>> 
			<td align="right" valign="middle" nowrap class="textBold"><?=translate_text("mat_khau")?> :</td>
			<td class="textBold"><input type="password" name="adm_password" size="50" maxlength="100" class="form"> </td>
			</tr>
			<tr <?=$fs_change_bg?>> 
			<td align="right" valign="middle" nowrap class="textBold"><?=translate_text("nhap_lai_mat_khau")?> :</td>
			<td class="textBold"><input  type="password" name="adm_password_con" size="50" maxlength="100" class="form"> </td>
			</tr>
			<tr <?=$fs_change_bg?>> 
			<td align="right" valign="middle" nowrap class="textBold">EMAIL :</td>
			<td> <input type="text" name="adm_email" size="50" maxlength="50" class="form">
			</td>
			</tr>
			<tr <?=$fs_change_bg?>> 
			<td align="right" valign="middle" nowrap class="textBold"><?=translate_text("phan_quyen_module")?> :</td>
			<td> 
			<table cellpadding="2" cellspacing="0" style="border-collapse:collapse" border="1" bordercolor="#DDF8CC">
				<tr bgcolor="#E0EAF3" height="30">
					<td class="textBold"><?=translate_text("select")?></td>
					<td class="textBold"><?=translate_text("module")?></td>
					<td class="textBold"><?=translate_text("add")?></td>
					<td class="textBold"><?=translate_text("edit")?></td>
					<td class="textBold"><?=translate_text("delete")?></td>
				</tr>
				<?
				while ($row=mysql_fetch_array($db_getallmodule->result)){
					if(file_exists("../" . $row["mod_path"] . "/config_security.php")===true){
					?>
						<tr>
							<td align="center"><input type="checkbox" name="mod_id[]" id="mod_id" value="<?=$row['mod_id'];?>"></td>
							<td class="textBold"><?=translate_text($row['mod_name']);?></td>
							<td align="center"><input type="checkbox" name="adu_add<?=$row['mod_id'];?>" id="adu_add<?=$row['mod_id'];?>" value="1"></td>
							<td align="center"><input type="checkbox" name="adu_edit<?=$row['mod_id'];?>" id="adu_edit<?=$row['mod_id'];?>" value="1"></td>
							<td align="center"><input type="checkbox" name="adu_delete<?=$row['mod_id'];?>" id="adu_delete<?=$row['mod_id'];?>" value="1"></td>
						</tr>
					<?
					}
				}
				unset($db_getall_channel);
				?>
			</table>
			</td>
			</tr>
			<tr <?=$fs_change_bg?>> 
				<td align="right" valign="middle" nowrap class="textBold">PHẠM VI HOẠT ĐỘNG:</td> 
				<td class="textBold"><input type="checkbox" name="adm_edit_all" value="1"> QUYỀN MODULE ĐƯỢC PHÉP TÁC ĐỘNG TỚI BẢN GHI CỦA THÀNH VIÊN KHÁC</td>
			</tr>
			 <tr <?=$fs_change_bg?>> 
				<td align="right" valign="middle" nowrap class="textBold"><?=translate_text("phan_ngon_ngu")?> :</td>
				<td> 
					<?
					$db_getall_languages = new db_query("SELECT * 
														 FROM languages
														 ORDER BY lang_id ASC");
					$cha_type="";
					?>
					<table cellpadding="2" cellspacing="0">
						<tr>
						<?
						while ($row=mysql_fetch_array($db_getall_languages->result)){
						?>
							<td><input type="checkbox" name="user_lang_id[]" checked="checked" id="user_lang_id" value="<?=$row['lang_id'];?>"></td>
							<td class="textBold"><?=$row['lang_name'];?></td>
						<?
						}
						unset($db_getall_channel);
						?>
						</tr>
					</table>
				</td>
			 </tr>
			<tr <?=$fs_change_bg?>> 
			<td align="right" valign="middle" nowrap class="textBold"><?=translate_text("quyen_category")?> :</td>
			<td class="textBold"><input type="text" name="keyword_relate" id="keyword_relate" size="25" class="form" onKeyUp="load_data('select_relate'); return false"> <input type="button" value="Tìm kiếm" onClick="load_data('select_relate');" class="form"> &nbsp; <?=translate_text("all_category")?>: <input type="checkbox" name="adm_all_category" id="adm_all_category" value="1"></td>
			</tr>
			<tr <?=$fs_change_bg?>> 
			<td align="right" valign="middle" nowrap class="textBold">&nbsp;</td>
			<td>
				<table cellpadding="0" cellspacing="0" style="border-collapse:collapse" border="1" bordercolor="#DDF8CC">
					<tr height="26" bgcolor="#E0EAF3">
						<td class="textBold"><?=translate_text("select_category")?></td>
						<td>&nbsp;</td>
						<td class="textBold"><?=translate_text("category_selected")?></td>
					</tr>
					<tr>
						<td>
							<div id="select_relate" style=" background:#FFFFFF;">
							<select id="list_relate" name="list_relate[]" class="form" multiple="multiple" size="20">
								<?
								for($i=0;$i<count($listAll);$i++){
								?>
									<option value="<?=$listAll[$i]["cat_id"]?>">
									<?
									for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
										echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"];
									?>
									</option>
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
						<td>
							<select id="arelate_select" name="arelate_select[]" multiple="multiple" class="form" size="20" style="width:250px"></select>
						</td>
					</tr>
				</table>
			</td>
			</tr>
			<tr valign="baseline"> 
			<td nowrap align="right"> </td>
			<td> <input type="button" class="form" onClick="selectAll('arelate_select'); document.add_user.submit();" value="<?=translate_text("save_change")?>"> 
			</td>
			</tr>
			</table>
			</td>
			<input type="hidden" name="Action" value="insert">
			</form>
			</tr>
		</table>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
<script language="javascript" src="../js/relate.js"></script>
<?
$db_getallmodule->close();
unset($db_getallmodule);
?>