<?
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("edit");

require_once("../../classes/database.php");
require_once("../../classes/generate_form.php");
require_once("../../functions/functions.php");

$ff_action = getURL();
$ff_redirect_succ = "listing.php";
$ff_redirect_fail = "";
$iAdm = getValue("iAdm");
$ff_table = "admin_user";

$fs_redirect	= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$record_id				= getValue("iAdm","int","GET");
$field_id		= "adm_id";
//kiểm tra quyền sửa xóa của user xem có được quyền ko
checkRowUser($fs_table,$field_id,$record_id,$fs_redirect);
$errorMsg="";
$Action = getValue("Action","str","POST","");

//Edit user profile
if ($Action =='update')
{
		//Call Class generate_form();
		$myform = new generate_form();
		$myform->add("adm_email","adm_email",2,0,"",1," Email không chính xác !",0,"");
		$myform->add("adm_all_category","adm_all_category",1,0,0,0,"",0,"");
		$myform->add("adm_edit_all","adm_edit_all",1,0,0,0,"",0,"");
		$myform->addTable($fs_table);
		$errorMsg .= $myform->checkdata();
		if($errorMsg == ""){
			$db_ex = new db_execute($myform->generate_update_SQL("adm_id",$iAdm));
			unset($db_ex);
			$module_list  			= getValue("mod_id","arr","POST","");
			$user_lang_id_list  	= getValue("user_lang_id","arr","POST","");
			$arelate_select  		= getValue("arelate_select","arr","POST","");
			
			$db_delete = new db_execute("DELETE FROM admin_user_right WHERE adu_admin_id =" . $iAdm);		
			unset($db_delete);
			if(isset($module_list[0])){
				for ($i=0; $i< count($module_list); $i++){
					$query_str = "INSERT INTO admin_user_right VALUES(" . $iAdm . "," . $module_list[$i] . ", " . getValue("adu_add" . $module_list[$i] , "int","POST") . ", " . getValue("adu_edit" . $module_list[$i] , "int","POST") . ", " . getValue("adu_delete" . $module_list[$i] , "int","POST") . ")";
					$db_ex = new db_execute($query_str);
					unset($db_ex);
				}
			}
			$db_delete = new db_execute("DELETE FROM admin_user_language WHERE aul_admin_id =" . $iAdm);		
			unset($db_delete);
			if(isset($user_lang_id_list[0])){
				for ($i=0; $i< count($user_lang_id_list); $i++){
					$query_str = "INSERT INTO admin_user_language VALUES(" . $iAdm . "," . $user_lang_id_list[$i] .")";
					$db_ex = new db_execute($query_str);
					unset($db_ex);
				}
			}
			$db_delete = new db_execute("DELETE FROM admin_user_category WHERE auc_admin_id =" . $iAdm);		
			unset($db_delete);
			if(getValue("adm_all_category","int","POST")==0){
				if(isset($arelate_select[0])){
					for ($i=0; $i<count($arelate_select); $i++){
						$query_str = "INSERT INTO admin_user_category VALUES(" . $iAdm . "," . $arelate_select[$i] .")";
						echo $query_str . '<br>';
						$db_ex = new db_execute($query_str);
						unset($db_ex);
					}
				}
			}
			redirect($ff_redirect_succ);
			exit();
		}
}

//Edit user password
if ($Action =='update_password')
{
}




//Select access module
$acess_module			= "";
$arrayAddEdit 			= array();
$db_access = new db_query("SELECT * 
									FROM admin_user, admin_user_right, modules
									WHERE adm_id = adu_admin_id AND mod_id = adu_admin_module_id AND adm_id =" . $iAdm);
while ($row_access = mysql_fetch_array($db_access->result)){
	$acess_module 			.= "[" . $row_access['mod_id'] . "]";
	$arrayAddEdit[$row_access['mod_id']] = array($row_access["adu_add"],$row_access["adu_edit"],$row_access["adu_delete"]);
}
unset($db_access);

//Select access channel
$access_channel="";
$db_category = new db_query("SELECT *
						   FROM categories_multi
						   WHERE 1 " . checkCategory($iAdm));

//Select access languages
$access_language="";
$db_access = new db_query("SELECT *
						   FROM admin_user, admin_user_language, languages
						   WHERE adm_id = aul_admin_id AND languages.lang_id = aul_lang_id AND adm_id =" . $iAdm);
while($row_access = mysql_fetch_array($db_access->result)) $access_language .="[" . $row_access['lang_id'] . "]";
unset($row_access);

//Check user exist or not
$db_admin_sel = new db_query("SELECT *
								  FROM admin_user
								  WHERE adm_id = " . $iAdm);
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
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr> 
				<td class="textBold" colspan="2" align="center">
					<font color="#FF0000"><?=$errorMsg;?></font>
				</td>
			</tr>
			<tr>
				<td align="center">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr> 
						<? $row = mysql_fetch_array($db_admin_sel->result); ?>
						<form ACTION="<?=$ff_action;?>" METHOD="POST" name="edit_user">
							<td>
								<table align="center" cellpadding="4" cellspacing="0" border="0">
									<tr class="bgTableBorder"> 
										<td class="textBold" colspan="2" align="center">EDIT USER PROFILE</td>
									</tr>
									<tr> 
										<td align="right" nowrap="nowrap" class="textBold">LOGIN NAME:</td>
										<td class="textBold">
											<?=$row['adm_loginname'];?>
										</td>
									</tr>
									<tr <?=$fs_change_bg?>> 
									<td align="right" valign="middle" nowrap class="textBold">EMAIL :</td>
									<td> <input type="text" name="adm_email" id="adm_email" value="<?=$row["adm_email"]?>" size="50" maxlength="50" class="form">
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
										while ($mod=mysql_fetch_array($db_getallmodule->result)){
											if(file_exists("../" . $mod["mod_path"] . "/config_security.php")===true){
											?>
												<tr>
													<td align="center"><input type="checkbox" name="mod_id[]" id="mod_id" value="<?=$mod['mod_id'];?>" <? if (strpos($acess_module, "[" . $mod['mod_id'] . "]") !== false) {?> checked="checked"<? } ?> ></td>
													<td class="textBold"><?=translate_text($mod['mod_name']);?></td>
													<td align="center"><input type="checkbox" name="adu_add<?=$mod['mod_id'];?>" id="adu_add<?=$mod['mod_id'];?>" <? if(isset($arrayAddEdit[$mod['mod_id']])){ if($arrayAddEdit[$mod['mod_id']][0]==1) echo ' checked="checked"'; }?> value="1"></td>
													<td align="center"><input type="checkbox" name="adu_edit<?=$mod['mod_id'];?>" id="adu_edit<?=$mod['mod_id'];?>" <? if(isset($arrayAddEdit[$mod['mod_id']])){ if($arrayAddEdit[$mod['mod_id']][1]==1) echo ' checked="checked"'; }?> value="1"></td>
													<td align="center"><input type="checkbox" name="adu_delete<?=$mod['mod_id'];?>" id="adu_delete<?=$mod['mod_id'];?>" <? if(isset($arrayAddEdit[$mod['mod_id']])){ if($arrayAddEdit[$mod['mod_id']][2]==1) echo ' checked="checked"'; }?> value="1"></td>
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
										<td class="textBold"><input type="checkbox" name="adm_edit_all" <? if($row["adm_edit_all"]==1) echo 'checked="checked"';?> value="1" > QUYỀN MODULE ĐƯỢC PHÉP TÁC ĐỘNG TỚI BẢN GHI CỦA THÀNH VIÊN KHÁC</td>
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
												while ($lan=mysql_fetch_array($db_getall_languages->result)){
												?>
													<td><input type="checkbox" name="user_lang_id[]" id="user_lang_id" value="<?=$lan['lang_id'];?>" <? if (strpos($access_language, "[" . $lan['lang_id'] . "]") !== false) {?> checked="checked"<? } ?>></td>
													<td class="textBold"><?=$lan['lang_name'];?></td>
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
									<td class="textBold"><input type="text" name="keyword_relate" id="keyword_relate" size="25" class="form" onKeyUp="load_data('select_relate'); return false"> <input type="button" value="Tìm kiếm" onClick="load_data('select_relate');" class="form"> &nbsp; <?=translate_text("all_category")?>: <input type="checkbox" name="adm_all_category" id="adm_all_category" <? if($row["adm_all_category"]==1) echo ' checked="checked"';?> value="1"></td>
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
													<select id="arelate_select" name="arelate_select[]" multiple="multiple" class="form" size="20" style="width:250px">
														<?
														while($cat=mysql_fetch_array($db_category->result)){
														?>
														<option value="<?=$cat["cat_id"]?>" selected="selected"><?=$cat["cat_name"]?></option>
														<?
														}
														?>
													</select>
												</td>
											</tr>
										</table>
									</td>
									</tr>
									<tr> 
										<td nowrap align="right"></td>
										<td>
											<input type="button" class="form" onClick="selectAll('arelate_select'); document.edit_user.submit();" value="<?=translate_text("save_change")?>">
										</td>
									</tr>
								</table>
							</td>
						<input type="hidden" name="Action" value="update">
						<input type="hidden" name="record_id" value="<?=$row["adm_id"]; ?>">
						</form>
						<!--Change password FORM -->
						<form ACTION="<?=$ff_action;?>?iAdm=<?=$iAdm?>" METHOD="POST" name="edit_password">
							<td valign="top">
								<table align="center" cellpadding="4" cellspacing="1" bordercolor="#CCCCCC" border="1" style="border-collapse:collapse">
									<tr class="bgTableBorder"> 
										<td class="textBold" colspan="2" align="center">EDIT USER PASSWORD</td>
									</tr>
									<tr> 
										<td align="right" nowrap="nowrap" class="textBold">NEW PASSWORD :</td>
										<td>
											<input type="password" name="adm_password" size="20" maxlength="50" class="form">
										</td>
									</tr>
									<tr> 
										<td align="right" nowrap="nowrap" class="textBold">CONFIRM PASSWORD :</td>
										<td>
											<input type="password" name="adm_password_con" size="20" maxlength="50" class="form">
										</td>
									</tr>
									<tr> 
										<td nowrap align="right"></td>
										<td> 
											<input type="button" class="button" value="Change password" onClick="check_form_change_password()"> 
										</td>
									</tr>
								</table>
							</td>
						<input type="hidden" name="Action" value="update_password">
						<input type="hidden" name="record_id" value="<?=$row["adm_id"]; ?>">
						</form>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<script language="javascript" src="../js/relate.js"></script>
</body>
<?
$db_admin_sel->close();
unset($db_admin_sel);
?>