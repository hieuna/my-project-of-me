<? include("config_security.php");?>
<? require_once("../../classes/database.php");?>
<? require_once("../../functions/functions.php");?>
<? require_once("../../functions/date_function.php");?>
<?
$record_id			= getValue("record_id", "str");
$db_getinfo 		= new db_query("SELECT * 
											 FROM orders
											 WHERE ord_id = " . $record_id . "");
if(mysql_num_rows($db_getinfo->result) > 0){
$row = mysql_fetch_array($db_getinfo->result);
?>
<html>
<head>
<title>Order Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
</head>
<body topmargin="4" leftmargin="4" rightmargin="4" bottommargin="4">
<script language='javascript'>
	function Fitimg(){
		//window.innerWidth:document.body.clientWidth; 
		//window.innerHeight:document.body.clientHeight;
		iWidth = document.body.clientWidth;  //Get default body
		iHeight = document.body.clientHeight;
		iWidth = document.images[0].width - iWidth ;
		iHeight = document.images[0].height - iHeight ;
		window.resizeBy(iWidth, iHeight);
	}
</script>
<style type="text/css">
.text{
	font-family:Tahoma, Verdana, Arial;
	font-size:11px;
	color:#000000;
	text-decoration:none;
}
a{font-family:Tahoma, Verdana, Arial;
	font-size:11px;
	color:#000000;
}
</style>
<table width="100%" cellpadding="4" cellspacing="0" border="1" style="border-collapse:collapse">
	<tr bgcolor="#D4D4D4">
		<td class="text" style="text-align:center" colspan="2">Mã số đơn hàng: <b style="color:#FF0000"><?=htmlspecialchars($row['ord_code']);?></b></td>
	</tr>
	<tr>
		<td align="center" class="textBold" width="50%">THÔNG TIN ĐẶT HÀNG</td>
		<td align="center" class="textBold" width="50%">THÔNG TIN NHẬN HÀNG</td>
	</tr>
	<tr>
		<td valign="top">
			<table width="100%" cellpadding="3">
				<? /*?>
				<tr>
					<td align="right" class="text" width="100">Mã số đơn hàng :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_code']);?></td>
				</tr>
				<? */?>
				<tr>
					<td align="right" class="text" width="100">Họ và tên :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_name']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="100">Email :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_email']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="100">Địa chỉ :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_address']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="100">Điện thoại :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_phone']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="100">Di động :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_mobile']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="100">Fax :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_fax']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="100">Thông tin thêm :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_otherinfo']);?></td>
				</tr>
			</table>
		</td>
		<td valign="top">
			<table width="100%" cellpadding="3">
				<tr>
					<td align="right" class="text" width="100">Họ và tên :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_sname']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="100">Email :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_semail']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="100">Địa chỉ :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_saddress']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="100">Điện thoại :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_sphone']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="100">Di động :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_smobile']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="100">Fax :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_sfax']);?></td>
				</tr>
				<tr>
					<td align="right" class="text" width="100">Thông tin thêm :</td>
					<td align="left" class="text"><?=htmlspecialchars($row['ord_sotherinfo']);?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<div style="padding:5px 0px 5px 0px">
<table width="100%" cellpadding="3" style="border:1px #FF3300 solid">
	<tr>
		<td align="right" class="text" width="120">Thời gian đặt hàng :</td>
		<td align="left" class="text">
		<?
		echo date("d/m/Y - H:i: A", $row["ord_date"]);
		?>
		</td>
	</tr>
	<tr>
		<td align="right" class="text" width="120">Giao hàng :</td>
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
		<td align="right" class="text" width="120">Thời gian giao hàng :</td>
		<td align="left" class="text"><?=htmlspecialchars($row['ord_delivery_time']);?></td>
	</tr>
	<tr>
		<td align="right" class="text" width="120">Hình thức thanh toán :</td>
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
		<td align="right" class="text" width="120">Trạng thái :</td>
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
</div>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<table width="100%" cellspacing="0" cellpadding="3" border="1" style="border-collapse:collapse">
				<tr bgcolor="#D4D4D4">
					<td class="textBold" align="center">STT</td>
					<td class="textBold" align="center">Tên hàng</td>
					<? /*?><td class="textBold" align="center">ĐVT</td><? */?>
					<td class="textBold" align="center">SL</td>
					<td class="textBold" align="center">Đơn giá</td>
					<td class="textBold" align="center">Thành tiền</td>
					<td class="textBold" align="center">Ghi chú</td>
				</tr>
				<?
				$array_cookie = explode("|",$row['ord_detail']);
				$total_money = 0;
				for ($i=0;$i<count($array_cookie)-1;$i=$i+3){
					$db_get = new db_query("SELECT *
													FROM categories_multi,products
													WHERE cat_id = pro_category AND cat_type = 'PRODUCT' AND pro_id =" . intval($array_cookie[$i]));
					if (mysql_num_rows($db_get->result)){
						$row_get = mysql_fetch_array($db_get->result);
				?>
				<tr>
					<td class="text" style="text-align:center; font-weight:bold;"><?=(int)($i/3)+1;?></td>
					<td class="text">
						<a target="_blank" href="../../home/detail.php?module=<?=strtolower($row_get["cat_type"])?>&iCat<?=$row_get['cat_id'];?>&iPro=<?=$row_get['pro_id'];?>"><?=$row_get['pro_name'];?></a>
					</td>
					<? /*?><td class="text" style="text-align:right"><?=$row_get['pro_unit'];?></td><? */?>
					<td class="text" style="text-align:right"><?=$array_cookie[$i+2];?></td>
					<td class="text" style="text-align:right"><?=number_format($array_cookie[$i+1],0,".",",");?></td>
					<td class="text" style="text-align:right"><?=number_format($array_cookie[$i+1] * $array_cookie[$i+2],0,".",",");?></td>
					<td class="text"></td>
				</tr>
				<?
						$total_money+=$array_cookie[$i+1] * $array_cookie[$i+2];
					}
				}
				?>
				<tr>
					<td colspan="4" rowspan="3">&nbsp;</td>
					<td align="center">Cộng</td>
					<td class="textBold" align="right"><?=number_format($total_money,0,".",",");?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="center">Thuế... %</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align="center" class="textBold">Tổng cộng</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="7" class="text"><strong>Số tiền bằng chữ</strong> : <em><?=int_to_words($total_money)?></em></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<div style="text-align:right; padding:5px" class="text"><a style="cursor:pointer" onClick="window.print()"><img align="absmiddle" border="0" hspace="5" src="../css/print.gif">Print</a></div>
</body>
</html>
<script language="javascript">
	self.moveTo((screen.width-document.body.clientWidth) / 2,(screen.height-document.body.clientHeight) / 2);
</script>
<?
}//End if(mysql_num_rows($db_getinfo->result))
$db_getinfo->close();
unset($db_getinfo);
?>