<? require_once("../classes/generate_form.php");?>
<?
$fs_table			= "review";
$today				= getdate();
$rev_date			= $today[0];
$fs_redirect		= getURLR($con_mod_rewrite);
$rev_name			= getValue("rev_name","str","POST","");
$rev_title			= getValue("rev_title","str","POST","");
$rev_uudiem			= getValue("rev_uudiem","str","POST","");
$rev_nhuoc			= getValue("rev_nhuoc","str","POST","");
$rev_description	= getValue("rev_description","str","POST","");
$rev_product		= getValue("rev_product","int","POST",0);
$rev_diem			= getValue("rev_diem","int","POST",5);

//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html
//$myform->removeHTML(0);
$myform->add("rev_name","rev_name",0,0,"",1,translate_display_text("ban_chua_nhap_ho_ten"),0,"");
$myform->add("rev_title","rev_title",0,0,"",1,translate_display_text("ban_chua_nhap_tieu_de"),0,"");
$myform->add("rev_uudiem","rev_uudiem",0,0,"",0,"",0,"");
$myform->add("rev_nhuoc","rev_nhuoc",0,0,"",0,"",0,"");
$myform->add("rev_description","rev_description",0,0,"",0,translate_display_text("ban_chua_nhap_noi_dung_danh_gia"),0,"");
$myform->add("rev_product","rev_product",1,0,0,0,"",0,"");
$myform->add("rev_diem","rev_diem",1,0,3,0,"",0,"");
$myform->add("rev_date","rev_date",1,0,1,0,"",0,"");
$myform->addTable($fs_table);
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
$security_code	= getValue("security_code", "int", "POST",0);
if($action == "insert"){
	if(!isset($_SESSION["session_security_code"])) redirect("index.php");
	if($security_code == $_SESSION["session_security_code"]){
		$errorMsg .= $myform->checkdata();
		if($errorMsg == ""){
			$db_ex = new db_execute($myform->generate_insert_SQL());
			//echo $myform->generate_insert_SQL();
			echo "<script language='javascript'>alert('" . translate_display_text("ban_da_gui_danh_gia_thanh_cong") . "')</script>";
			redirect($fs_redirect);
			exit();
		}else{
			echo "<script language='javascript'>alert('" . $errorMsg . "')</script>";
		} 
		$_SESSION["session_security_code"] = rand(1000,9999);
	}else{
		echo "<script language='javascript'>alert('" . translate_display_text("ma_bao_mat_khong_chinh_xac") . "')</script>";
	}
}
echo $myform->strErrorFeld;
//add form for javacheck
$myform->addFormname("form_review");
$myform->checkjavascript();
?>
<div class="textBold" align="center" style="background:#FFFFCC; padding:5px;">&nbsp;</div>
<table cellpadding="3" cellspacing="0" align="center">
	<form action="<?=getURLR($con_mod_rewrite)?>" name="form_review" id="form_review" method="post">
			<input type="hidden" name="action" value="insert" />
			<?
			$rev_product=getValue("iData","int","GET",0);
			?>
			<input type="hidden" name="rev_product" value="<?=$rev_product?>">
			<input type="hidden" name="rev_date" value="<?=$rev_date?>">
	<tr>
		<td class="textBold"><?=translate_display_text("ho_va_ten")?><font color="#FF0000"> *</font> : </td>
		<td><input type="text" name="rev_name" id="rev_name" style="width:200px" class="form" value="<?=$rev_name?>"></td>
	</tr>
	<tr>
		<td class="textBold"><?=translate_display_text("tieu_de")?><font color="#FF0000"> *</font> : </td>
		<td><input type="text" name="rev_title" id="rev_title" style="width:400px" class="form" value="<?=$rev_title?>"></td>
	</tr>
	<tr>
		<td colspan="2" class="textBold"><?=translate_display_text("cham_diem_cho_san_pham")?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td class="textBold">
			<? for($i=1;$i<=10;$i++){?>
				<div><? if(strlen($i)==1) echo "&nbsp;&nbsp;" . $i; else echo $i;?> <?=translate_display_text("diem")?> : <input type="radio" name="rev_diem" id="rev_diem" value="<?=$i?>" <? if($i==$rev_diem) echo 'checked';?>><script language="javascript">start(<?=$i?>)</script></div>
			<? }?>
		</td>
	</tr>
	<tr>
		<td class="textBold"></td>
	</tr>
	<tr>
		<td colspan="2" class="textBold"><?=translate_display_text("viet_noi_dung_chi_tiet_danh_gia_duoi_day")?> : </td>
	</tr>
	<tr>
		<td colspan="2"><textarea name="rev_description" id="rev_description" class="form" style="width:500px; height:150px;" rows="15"><?=$rev_description?></textarea></td>
	</tr>
	<tr>
		<td class="textBold"><?=translate_display_text("ma_bao_mat")?> : </td>
		<td><? $_SESSION["session_security_code"] = rand(1000,9999);?><img src="<?=$lang_path?>security_code.php" align="absmiddle" style="border:solid 1px #666666" />&nbsp;<input style="height:14px; width:85px;" type="text" name="security_code" class="form" value="" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>			
			<input type="button" class="buttom"  value="&nbsp;&nbsp;<?=translate_display_text("gui_di")?>&nbsp;&nbsp;" onclick="validateForm();" />
		</td>
	</tr>
	</form>
</table>
<?
?>
