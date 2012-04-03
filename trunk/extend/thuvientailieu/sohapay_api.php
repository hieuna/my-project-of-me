<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SilverHand" />
	<title>Transaction API</title>
</head>
<body>
<?php
include('../class/class_payment.php');
$sever = "localhost";
$user = "thuvient";
$password = "159357mm";
$database = "thuvient_TVso1VN";

$link = mysql_connect($sever,$user,$password) or die("Kết nối không thành công". mysql_error());
mysql_query("SET NAMES 'UTF8'",$link);
$results = mysql_select_db($database, $link);
if(isset($_POST['hid'])){
	//SOHAPAY
	$classPayment = new PG_checkout();
	
	$id = $_POST['userid'];	
	$order_code = time();
	$return_url = 'http://thuvientailieu.net/API/sohapay_api.php';
	$transaction_info = 'Nạp tiền từ thuvientailieu.net qua cổng thanh toán SohaPay';
	$order_price = $_POST['price_shp'];
	$order_email = $_POST['user_email'];
	$order_phone = '';
	$sohapay_checkout_url = $classPayment->buildCheckoutUrl($return_url, $transaction_info, $order_code, $order_price, $order_email, $order_phone);
	?>
	<script type="text/javascript">
	window.location = "<?php echo $sohapay_checkout_url;?>";
	</script>
	<?php
}
$error_text = $_GET['error_text'];
if ($error_text !=""){
	?>
	<table border="5" cellpadding="5" cellspacing="0" align="center">
		<tr>
			<td align="right"><font color="red"></font> Thông báo lỗi</td>
			<td align="left"><b style="color:red;"><?php echo 'Giao dich không thành công !'; ?></b></td>
		</tr>
		<tr>
			<td></td>
			<td align="left">
			<input type="button" value="Quay lại trang chủ" onclick="javascript: window.location='http://thuvientailieu.net/forum.php';" />
			</td>
		</tr>
	</table>
	<?php
}else{
	$money = $order_price/1000;
	$gold = $money*2;
	$time = date("d/m/y  H:i:s"); 
	$money=$order_price;
	$myStrSQL2="insert into napthe values ('','','$money','$time')";
	mysql_query($myStrSQL2);
	$total_results = mysql_result(mysql_query("SELECT money FROM user where userid='$id'"),0);	   
	$gold_update= $total_results+ $gold;
	$myStrSQL1="update user set money='$gold_update' where userid='$id'";
	 mysql_query($myStrSQL1);
	?>
	<table border="5" cellpadding="5" cellspacing="0" align="center">
		<tr>
			<td align="right"><font color="red"></font> Trạng thái đơn hàng</td>
			<td align="left"><b style="color:green;"><?php echo 'Giao dich thành công !'; ?></b></td>
		</tr>
		<tr>
			<td></td>
			<td align="left">
			<input type="button" value="Quay lại trang chủ" onclick="javascript: window.location='http://thuvientailieu.net/forum.php';" />
			</td>
		</tr>
	</table>	
	<?php
}
?>
</body>
</html>