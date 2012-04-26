<? include ("config_security.php"); ?>
<? require_once("../../classes/database.php");?>
<? require_once("../../functions/functions.php");?>
<?
$ord_id		= getValue("ord_id", "int");
$ord_status	= getValue("ord_status", "int", "GET", 1);
if($ord_id != 0){
	if($ord_status == 4){
		$ord_email = getValue("ord_email", "str", "GET", "");
		$message = "Hi. your order in Website " . $_SERVER['SERVER_NAME'] . " has been finish\n";
		$message.= "You can check order status in Website http://" . $_SERVER['SERVER_NAME'];
		
		$to      = $ord_email;
		$subject = "Hi . you have an contact from website " . $_SERVER['SERVER_NAME'];
		$headers = 'From: admin@' . str_replace("www.","",$_SERVER['SERVER_NAME']);
		//echo $message . "<br>" . $to;
		//mail($to, $subject, $message, $headers);
		/*
		//Send email to User
		require_once("../../home/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SetLanguage("vn", "");
		$mail->Host     = "localhost";
		$mail->SMTPAuth = true;
		
		////////////////////////////////////////////////
		// Ban hay sua cac thong tin sau cho phu hop
		
		$mail->Username = "mail@au-delice.vn";				// SMTP username
		$mail->Password = "123456"; 				// SMTP password
		
		$mail->From     = "mail@au-delice.vn";				// Email duoc gui tu???
		$mail->FromName = "Au-delice Website";					// Ten hom email duoc gui
		
		$to_array = split(",",$to);
		for ($i=0;$i<count($to_array);$i++){
			$mail->AddAddress($to_array[$i],"Admin");	 	// Dia chi email va ten nhan
		}
		
		$mail->AddReplyTo("mail@au-delice.vn","Information");		// Dia chi email va ten gui lai
		
		$mail->IsHTML(false);						// Gui theo dang HTML
		
		$mail->Subject  =  $subject;				// Chu de email
		$mail->Body     =  $message;		// Noi dung html
		
		
		$mail->Send();
		*/
	}
	redirect("listing.php");
}
$record_id = getValue("record_id");

$db_getinfo = new db_query("SELECT * 
									 FROM orders
									 WHERE ord_id=" . $record_id . "");

if(mysql_num_rows($db_getinfo->result) > 0){
	$row = mysql_fetch_array($db_getinfo->result);
}
?>
<html>
<head>
<title>Check order</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSportal.css" rel="stylesheet" type="text/css">
</head>
<center>
<? template_top(translate_text("chi_tiet_don_hang"))?>			
<table width="600" cellpadding="4" cellspacing="0" border="1" style="border-collapse:collapse; margin-top:10px;" bordercolor="#CCCCCC"><tr>
		<td align="center"><a href="listing.php">.: <?=translate_text("tro_lai_danh_sach_don_hang")?> :.</a></td>
	</tr>
	<tr>
		<td class="textBold"><?=translate_text("TH_TIN_DAT_HANG")?></td>
	</tr>
	<tr>
		<td>
			<table width="100%" cellpadding="3">
				<tr>
					<td align="right" class="text" width="150"><?=translate_text("ma_so_don_hang")?> :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_id']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Họ tên người đặt hàng :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_name']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Email :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_email']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Địa chỉ :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_address']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Điện thoại :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_phone']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Di động :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_mobile']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Fax :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_fax']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Thông tin thêm :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_otherinfo']);?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="textBold">THÔNG TIN NHẬN HÀNG</td>
	</tr>
	<tr>
		<td>
			<table width="100%" cellpadding="3">
				<tr>
					<td align="right" class="text" width="150">Họ tên người nhận :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_sname']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Email :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_semail']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Địa chỉ :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_saddress']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Điện thoại :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_sphone']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Di động :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_smobile']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Fax :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_sfax']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Thông tin thêm :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_sotherinfo']);?></td>
				</tr>
				<tr>
					<td colspan="2"><hr size="1" color="#CCCCCC"/></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Thời gian đặt hàng :</td>
					<td align="left" class="text">
					<?
					echo date("d/m/Y - H:i: A", $row["ord_date"]);
					?>
					</td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Giao hàng :</td>
					<td align="left" class="text">
					<?
					$arrDelivery = array("Đến địa chỉ người nhận"=> 1,
												"Khách đến nhận hàng"	=> 2,
												"Qua bưu điện"				=> 3,
												"Hình thức khác"			=> 4,);
					foreach($arrDelivery as $key => $value){
						if($value == $row['ord_delivery']){
							echo $key;
							break;
						}
					}
					?>
					</td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Thời gian giao hàng :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_delivery_time']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="150">Hình thức thanh toán :</td>
					<td align="left" class="text">
					<?
					switch($row['ord_payment']){
						case 1:
							echo "Thẻ ATM";
							break;
						case 2:
							echo "Chuyển khoản";
							break;
						default:
							echo "Tiền mặt";
							break;
					}
					?>
					</td>
				</tr>
				<? /*?>
				<tr>
					<td align="right" class="text" width="150">Trạng thái :</td>
					<td align="left" class="text">
					<form name="order_status" action="order_detail.php" method="get">
						<select name="ord_status" class="form">
						<?
						$order_status = array("Waiting", "Pending", "Delivering", "Finish", "Cancel");
						?>
						<?
						$i = 0;
						foreach($order_status as $value){
							$i++;
						?>
							<option value="<?=$i?>" <? if($i == $row["ord_status"]){echo "selected='selected'";}?>><?=$value?></option>
						<?
						}
						?>
						</select>
						<input type="hidden" name="ord_id" value="<?=$row["ord_id"]?>">
						<input type="hidden" name="ord_email" value="<?=htmlspecialchars($row["ord_email"])?>">
						<input type="submit" value="Save" class="button">
					</form>
					</td>
				</tr>
				<? */?>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" cellspacing="0" cellpadding="3" border="1" style="border-collapse:collapse" bordercolor="#CCCCCC">
				<tr bgcolor="#D4D4D4">
					<td class="textBold" align="center">Thứ tự</td>
					<td class="textBold" align="center">Tên mặt hàng</td>
					<td class="textBold" align="center">Số lượng</td>
					<td class="textBold" align="center">Giá</td>
					<? /*?><td class="textBold" align="center">Đơn vị</td><? */?>
					<td class="textBold" align="center">Thành tiền</td>
				</tr>
				<?
				$array_cookie	= explode("|",$row['ord_detail']);
				$total_money	= 0;
				$strProduct		= "";
				for ($i=0;$i<count($array_cookie)-1;$i=$i+3){
					$db_get = new db_query("SELECT *
													FROM categories_multi,products
													WHERE cat_id = pro_category AND cat_type = 'PRODUCT' AND pro_id =" . intval($array_cookie[$i]));
					if(mysql_num_rows($db_get->result)){
						$row_get = mysql_fetch_array($db_get->result);
						$money	= $array_cookie[$i+1];
						$totalM	= $array_cookie[$i+1] * $array_cookie[$i+2];
						if($money == 0)$strProduct .= " + <a style='font-weight:normal' class='product_name_1' href='../../home/detail.php?module=" . strtolower($row_get["cat_type"]) . "&iCat=" . $row_get["cat_id"] . "&iPro=" . $row_get["pro_id"] . "'>" . $row_get["pro_name"] . "</a>";
				?>
					<tr>
						<td style="text-align:center" class="text"><?=(int)($i/3)+1;?></td>
						<td class="text">
							<a target="_blank" href="../../<?=$_SESSION["lang_path"]?>/detail.php?module=<?=strtolower($row_get["cat_type"])?>&iCat=<?=$row_get['cat_id'];?>&iData=<?=$row_get['pro_id'];?>"><?=$row_get['pro_name'];?></a>
						</td>
						<td align="right" class="text" style="text-align:right"><?=$array_cookie[$i+2];?></td>
						<td align="right" class="text" style="color:#FF0000"><? if($money != 0){echo number_format($money,0,".",",");}else{echo "Thỏa thuận";}?></td>
						<? /*?><td align="left" class="text"><?=$row_get['pro_unit'];?></td><? */?>
						<td align="right" class="text" style="color:#FF0000"><? if($totalM != 0){echo number_format($totalM,0,".",",");}else{echo "Thỏa thuận";}?></td>
					</tr>
				<?
					$total_money+=$array_cookie[$i+1] * $array_cookie[$i+2];
					}
				}
				?>
				<tr>
					<td colspan="7" class="textBold" align="right">Tổng cộng : <font color="#FF0000"><?=number_format($total_money,0,".",",");?></font> <?=$strProduct?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><a style="cursor:pointer" onClick="window.open('print_order.php?record_id=<?=$row["ord_id"]?>','','resizable=1,width=650,height=680,scrollbars=1')"><img align="absmiddle" border="0" hspace="5" src="../css/print.gif"><?=translate_text("In_don_hang")?></a></td>
	</tr>
</table>
</center>
</html>
<?
unset($db_getinfo);
?>