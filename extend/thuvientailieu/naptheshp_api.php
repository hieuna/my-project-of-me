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

function randomcode($len=5)
{
	$pass = $lchar = NULL;
	for( $i=0; $i<$len; $i++ )
	{
		$char = chr(rand(48,122));
		while( !ereg("[0-9]", $char) )
		{
			if( $char == $lchar ) continue;
			$char = chr(rand(48,90));
		}
		$pass .= $char;
		$lchar = $char;
	}
	return $pass;
}

if(isset($_POST['hid'])){
	//Lấy thông tin giao dịch
	$transaction_info=$_POST["transaction_info"];
	//Lấy mã đơn hàng 
	$order_code= randomcode().'-'.time();;
	//Lấy email 
	$order_email=$_POST["user_email"];
	//Lấy mobile 
	$order_mobile=$_POST["order_mobile"];
	//Lấy card_type 
	$card_type=$_POST["card_type"];
	//Lấy card_code 
	$card_code=$_POST["card_code"];
	//Lấy card_seri 
	$card_seri=$_POST["card_seri"];
	//lay name va id
	$id = $_POST['userid'];
	$name = $_POST['user_name'];

	//Khai báo đối tượng của lớp PG_Checkout
	$classPayment= new PG_checkout();
	
	$arrReturn = $classPayment->doChargeCard($card_code, $card_type, $transaction_info, $order_code, $order_email, $order_mobile, $card_seri);
	//var_dump($arrReturn);
	if ($arrReturn['response_code'] == 1){
		$money = $arrReturn['price']/100;
		$gold = $money*2;
		$time = date("d/m/y  H:i:s"); 
		$myStrSQL2="insert into napthe values ('','$name','$money','$time')";
		mysql_query($myStrSQL2);
		$total_results = mysql_result(mysql_query("SELECT money FROM user where userid='$id'"),0);
	   
		$gold_update= $total_results+ $gold;
		$myStrSQL1="update user set money='$gold_update' where userid='$id'";
		 mysql_query($myStrSQL1);
	}
	?>
	<table border="5" cellpadding="5" cellspacing="0" align="center">
	    <tr>
			<td align="right"><font color="red"></font> Mã đơn hàng</td>
			<td align="left"><?php echo $arrReturn['order_code']; ?></td>
		</tr>
		<tr>
			<td align="right"><font color="red"></font> Tổng giá trị thanh toán</td>
			<td align="left"><?php echo $arrReturn['price']; ?></td>
		</tr>
		<tr>
			<td align="right"><font color="red"></font> Thời gian thanh toán</td>
			<td align="left"><?php echo $arrReturn['payment_time']; ?></td>
		</tr>
		<tr>
			<td align="right"><font color="red"></font> Thông tin đơn hàng</td>
			<td align="left"><?php echo $arrReturn['transaction_info']; ?></td>
		</tr>
		<tr>
			<td align="right"><font color="red"></font> Trạng thái đơn hàng</td>
			<td align="left"><?php if ($arrReturn['response_code'] == 1) echo 'Thanh toán thành công'; else 'Thanh toán không thành công !'; ?> </td>
		</tr>
		<tr>
			<td align="right"><font color="red"></font> Kết quả giao dịch</td>
			<td align="left"><?php echo $arrReturn['shp_payment_response_description']; ?></td>
		</tr>
		<tr>
			<td align="right"><font color="red"></font> Mô tả kết quả giao dịch</td>
			<td align="left"><?php echo $arrReturn['response_message']; ?></td>
		</tr>
		<tr>
			<td align="right"><font color="red"></font> Email</td>
			<td align="left"><?php echo $arrReturn['order_email']; ?></td>
		</tr>
		<tr>
			<td align="right"><font color="red"></font> Thông báo lỗi</td>
			<td align="left"><?php echo $arrReturn['error_text']; ?></td>
		</tr>
	</table>
	<?php
}

?>
<script type="text/javascript">
//window.location = "<?php echo $sohapay_checkout_url;?>";
</script>
</body>
</html>