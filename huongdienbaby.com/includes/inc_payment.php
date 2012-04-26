<?
require_once("../classes/database.php");
require_once("../functions/functions.php");
require_once("../classes/generate_form.php");
$myform 			= new generate_form();
	$ord_date				= getValue("ord_date", "int", "POST");
	$ord_month				= getValue("ord_month", "int", "POST");
	$ord_year				= getValue("ord_year", "int", "POST");
	$ord_detail				= getValue("order", "str", "COOKIE","");
	$ord_delivery_time 		= " " . $ord_date . "/" . $ord_month . "/" . $ord_year;
	$ord_date				= time();
	$ord_status				= 1;
//Add table
$myform->add("ord_name","ord_name",0,0," ",1,translate_display_text("ban_chua_nhap_ho_ten_nguoi_dat"),0,"");
$myform->add("ord_address","ord_address",0,0,"",1,translate_display_text("ban_chua_nhap_dia_chi_nguoi_dat_hang"),0,"");
$myform->add("ord_email","ord_email",2,0,"",1,translate_display_text("dia_chi_email_nguoi_dat_khong_hop_le"),0,"");
$myform->add("ord_phone","ord_phone",0,0,"",1,translate_display_text("Ban_chua_nhap_so_dien_thoai_nguoi_dat"),0,"");
$myform->add("ord_mobile","ord_mobile",0,0,"",0,"",0,"");
$myform->add("ord_fax","ord_fax",0,0,"",0,"",0,"");
$myform->add("ord_otherinfo","ord_otherinfo",0,0,"",0,"",0,"");
//thong tin nguoii nhan
$myform->add("ord_sname","ord_sname",0,0,"",1,translate_display_text("Ban_chua_nhap_ho_ten_nguoi_nhan"),0,"");
$myform->add("ord_saddress","ord_saddress",0,0,"",1,translate_display_text("Ban_chua_nhap_dia_chi_nguoi_nhan"),0,"");
$myform->add("ord_semail","ord_semail",2,0,"",1,translate_display_text("Dia_chi_email_nguoi_nhan_khong_hop_le"),0,"");
$myform->add("ord_sphone","ord_sphone",0,0,"",1,translate_display_text("Ban_chua_nhap_so_dien_thoai_nguoi_nhan"),0,"");
$myform->add("ord_smobile","ord_smobile",0,0,"",0,"",0,"");
$myform->add("ord_sfax","ord_sfax",0,0,"",0,"",0,"");
$myform->add("ord_sotherinfo","ord_sotherinfo",0,0,"",0,"",0,"");
$myform->add("ord_detail","ord_detail",0,1,"",0,"",0,"");
$myform->add("ord_delivery_time","ord_delivery_time",0,1,"",0,"",0,"");
$myform->add("ord_date","ord_date",1,1,1,0,"",0,"");
$myform->add("ord_status","ord_status",1,1,1,0,"",0,"");
$myform->addTable("orders");
$errorMsg 	= "";
$action 	= getValue("action","str","POST","");
$scode		= getValue("scode", "int", "POST");	
$ErrorCode	= '';
if($action == "themmoi"){
	$errorMsg 	= $myform->checkdata();
	if($errorMsg == ""){
	
		$db_ex	 = new db_execute_return();
		$last_id = $db_ex->db_execute($myform->generate_insert_SQL());
		$_SESSION['order_id'] = $last_id;
		//echo $myform->generate_insert_SQL();
		echo "<script language='javascript'>
					if (confirm('" . translate_display_text("ban_da_gui_don_hang_thanh_cong") . "\\r" . translate_display_text("Ban_muon_xem_va_in_don_hang") . "')){
						window.location.href='" . $lang_path . "orderview.php';
					}
				</script>";
		redirect($lang_path,1);
		exit();
	}
}

$myform->addFormname("payment");
$myform->evaluate();
$myform->checkjavascript();
echo $myform->strErrorFeld;
echo $errorMsg;
$arrRequire = $myform->array_data_require;
?>
<form name="payment" method="post" action="<?=getURL()?>" onSubmit="validateForm(); return false" style="margin:0px; padding:0px;">
	<input type="hidden" name="action" value="themmoi">
<script language="javascript">
	function checksame(){
		if (document.getElementById("check_same").checked){
			
			document.getElementById("ord_sname").value		= document.getElementById("ord_name").value;
			document.getElementById("ord_saddress").value	= document.getElementById("ord_address").value;
			document.getElementById("ord_semail").value		= document.getElementById("ord_email").value;
			document.getElementById("ord_sphone").value		= document.getElementById("ord_phone").value;
			document.getElementById("ord_smobile").value	= document.getElementById("ord_mobile").value;
			document.getElementById("ord_sfax").value		= document.getElementById("ord_fax").value;
			document.getElementById("ord_sotherinfo").value = document.getElementById("ord_otherinfo").value;
		}
	}
</script>
<div class="t_top"><div><?=translate_display_text("thong_tin_thanh_toan")?></div></div>
	<div class="t_center">
		<table width="100%" cellpadding="5" cellspacing="2">
			<tr>
				<td></td>
				<td><?=translate_display_text("Nhung_muc_co_dau")?> <font class="form_asterisk">(*)</font> <?=translate_display_text("la_bat_buoc_phai_nhap")?> .</td>
			</tr>
			<tr>
				<td align="left" nowrap class="form_title" colspan="2" style="padding-left:20px"><?=translate_display_text("THONG_TIN_NGUOI_DAT_HANG")?>  :</td>
			</tr>
			<tr>
				<td align="right" nowrap><?=translate_display_text("Ho_va_ten")?>  :</td>
				<td class="form_asterisk"><input value="<?=$ord_name?>" name="ord_name" id="ord_name" type="text" class="form" size="35" maxlength="50">  <?=sao($arrRequire["ord_name"])?></td>
			</tr>
			<tr>
				<td align="right" nowrap><?=translate_display_text("Gioi_tinh")?>  :</td>
				<td class="form_asterisk">
					<select name="ord_gender" id="ord_gender" class="form">
						<option value="1"><?=translate_display_text("Nam")?> </option>
						<option value="0" ><?=translate_display_text("Nu")?> </option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" nowrap><?=translate_display_text("Dia_chi")?>  :</td>
				<td class="form_asterisk" nowrap="nowrap"><input value="<?=$ord_address?>" name="ord_address" id="ord_address" type="text" class="form" size="50"> <?=sao($arrRequire["ord_address"])?></td>
			</tr>
			<tr>
				<td align="right" nowrap>E-mail :</td>
				<td class="form_asterisk"><input value="<?=$ord_email?>" name="ord_email" id="ord_email" type="text" class="form" size="40" maxlength="60"> <?=sao($arrRequire["ord_email"])?> </td>
			</tr>
			<tr>
				<td align="right" nowrap><?=translate_display_text("Dien_thoai")?>  :</td>
				<td class="form_asterisk"><input value="<?=$ord_phone?>" name="ord_phone" id="ord_phone" type="text" class="form" size="30" maxlength="50"> <?=sao($arrRequire["ord_phone"])?></td>
			</tr>
			<tr>
				<td align="right" nowrap><?=translate_display_text("Di_dong")?> :</td>
				<td><input value="<?=$ord_mobile?>" name="ord_mobile" id="ord_mobile" type="text" class="form" size="30" maxlength="50"> <?=sao($arrRequire["ord_mobile"])?></td>
			</tr>
			<tr>
				<td align="right" nowrap>Fax :</td>
				<td><input value="<?=$ord_fax?>" name="ord_fax" id="ord_fax" type="text" class="form" size="30" maxlength="50"> <?=sao($arrRequire["ord_mobile"])?></td>
			</tr>
			<tr>
				<td align="right" valign="top"><?=translate_display_text("Ghi_chu")?> :</td>
				<td><textarea name="ord_otherinfo" id="ord_otherinfo" class="form" cols="50" rows="8"></textarea> <?=sao($arrRequire["ord_otherinfo"])?></td>
			</tr>
			<tr>
				<td align="right" nowrap class="order_status" colspan="2"><hr size="1" width="98%" color="#999999" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" class="form_title" colspan="2" style="padding-left:20px"><?=translate_display_text("THONG_TIN_NGUOI_NHAN_HANG")?> :</td>
			</tr>
			<tr>
				<td></td>
				<td nowrap="nowrap"><input type="checkbox" id="check_same" id="check_same" onClick="checksame()">&nbsp;<label for="check_same"><?=translate_display_text("Thong_tin_nguoi_nhan_trung_voi_thong_tin_nguoi_dat")?></label></td>
			</tr>
			<tr>
				<td align="right" nowrap><?=translate_display_text("Ho_va_ten")?> :</td>
				<td class="form_asterisk"><input name="ord_sname" id="ord_sname" type="text" class="form" size="35" value="<?=$ord_sname?>" maxlength="50"> <?=sao($arrRequire["ord_sname"])?></td>
			</tr>
			<tr>
				<td align="right" nowrap><?=translate_display_text("Gioi_tinh")?> :</td>
				<td class="form_asterisk">
					<select name="ord_sgender" id="ord_sgender" class="form">
						<option value="1"><?=translate_display_text("Nam")?></option>
						<option value="0"><?=translate_display_text("Nu")?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" nowrap><?=translate_display_text("Dia_chi")?> :</td>
				<td class="form_asterisk" nowrap="nowrap"><input name="ord_saddress" id="ord_saddress" type="text" value="<?=$ord_saddress?>" class="form" size="50"> <?=sao($arrRequire["ord_saddress"])?></td>
			</tr>
			<tr>
				<td align="right" nowrap>E-mail :</td>
				<td class="form_asterisk"><input name="ord_semail" id="ord_semail" type="text" class="form" size="40" value="<?=$ord_semail?>"> <?=sao($arrRequire["ord_semail"])?></td>
			</tr>
			<tr>
				<td align="right" nowrap><?=translate_display_text("Dien_thoai")?> :</td>
				<td class="form_asterisk"><input name="ord_sphone" id="ord_sphone" type="text" class="form" size="30" value="<?=$ord_sphone?>"> <?=sao($arrRequire["ord_sphone"])?></td>
			</tr>
			<tr>
				<td align="right" nowrap><?=translate_display_text("Di_dong")?> :</td>
				<td><input name="ord_smobile" id="ord_smobile" type="text" class="form" size="30" value="<?=$ord_smobile?>"> <?=sao($arrRequire["ord_smobile"])?></td>
			</tr>
			<tr>
				<td align="right" nowrap>Fax :</td>
				<td><input name="ord_sfax" id="ord_sfax" type="text" class="form" size="30" value="<?=$ord_sfax?>"> <?=sao($arrRequire["ord_sfax"])?></td>
			</tr>
			<tr>
				<td align="right" valign="top"><?=translate_display_text("Ghi_chu")?> :</td>
				<td><textarea name="ord_sotherinfo" id="ord_sotherinfo" class="form" cols="50" rows="8"><?=$ord_sotherinfo?></textarea> <?=sao($arrRequire["ord_sotherinfo"])?></td>
			</tr>
			<tr>
				<td align="right" nowrap class="order_status" colspan="2"><hr size="1" width="98%" color="#999999" /></td>
			</tr>
			<tr>
				<td nowrap="nowrap" class="form_title" colspan="2" style="padding-left:20px"><?=translate_display_text("VAN_CHUYEN_VA_THANH_TOAN")?> :</td>
			</tr>
			<tr>
				<td align="right" nowrap><?=translate_display_text("Hinh_thuc_van_chuyen")?> :</td>
				<td> 
					<select name="ord_delivery" id="ord_delivery" class="form">
						<option value="1"><?=translate_display_text("den_dia_chi_nguoi_nhan")?></option>
						<option value="2"><?=translate_display_text("Khach_den_nhan_hang")?></option>
						<option value="3"><?=translate_display_text("Qua_buu_dien")?></option>
						<option value="4"><?=translate_display_text("Hinh_thuc_khac")?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right" nowrap><?=translate_display_text("Thoi_gian_van_chuyen")?> :</td>
				<td class="form_asterisk"> 
					<select name="ord_date" id="ord_date" class="form">
					<?
					$date		= date("d");
					$month	= date("m");
					$year		= date("Y");
					for($i=1;$i<=31;$i++){
					?>
					<option value=<?=$i?> <? if($i == $date){echo "selected='selected'";}?>><?=$i?></option>";
					<?
					}
					?>
					</select>
					<select name="ord_month" id="ord_month" class="form">
					<?
					for($i=1;$i<=12;$i++){
					?>
					<option value=<?=$i?> <? if($i == $month){echo "selected='selected'";}?>><?=$i?></option>";
					<?
					}
					?>
					</select>
					<select name="ord_year" id="ord_year" class="form">
					<?
					$y = date("Y");
					for($i=$y;$i<$y+5;$i++){
					?>
					<option value=<?=$i?> <? if($i == $year){echo "selected='selected'";}?>><?=$i?></option>";
					<?
					}
					?>
					</select>
					<br />
					<font>(Ví dụ: hh:mm <?=translate_display_text("Ngay_thang_nam")?>)</font>
				</td>
			</tr>
			<tr> 
				<td align="right" nowrap><?=translate_display_text("Hinh_thuc_thanh_toan")?> :</td>
				<td> 
					<select name="ord_payment" id="ord_payment" class="form">
						<option value="0"><?=translate_display_text("Tien_mat")?></option>
						<option value="1"><?=translate_display_text("The_ATM")?></option>
						<option value="2"><?=translate_display_text("chuyen_khoan")?></option>
					</select>
				</td>
			</tr>	  
			<tr height="50"> 
				<td nowrap align="right">&nbsp;</td>
					<td>
						<input type="submit" class="buttom" value="<?=translate_display_text("Gui_di")?>">
						<input type="reset" class="buttom" value="<?=translate_display_text("Lam_lai")?>"> 
				</td>
			</tr>
			<? 
			$db_footer = new db_query("SELECT sta_id, sta_title, sta_description FROM statics WHERE sta_id = " . intval($con_static_payment));
			?>
			<? if($footer = mysql_fetch_array($db_footer->result)){?>
			<tr>
				<td colspan="2">
					<div class="description"><?=$footer["sta_description"]?></div>
				</td>
			</tr>
			<? }?>
		</table>
		</form>
 </div>
<div class="t_bottom"><div>&nbsp;</div></div>
