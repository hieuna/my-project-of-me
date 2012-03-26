<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SilverHand" />
	<title>Transaction API</title>
</head>
<body>
<?php
include('../class/BKTransactionAPI.php');
$sever = "localhost";
$user = "thuvient_TVso1VN";
$password = "@WYS%^$SDFA*&+@";
$database = "thuvient_TVso1VN";

$link = mysql_connect($sever,$user,$password) or die("Kết nối không thành công". mysql_error());
mysql_query("SET NAMES 'UTF8'",$link);
$results = mysql_select_db($database, $link);
if(isset($_POST['sbNapThe'])){
	$seri = $_POST['txtSoSeri'];
	$sopin = $_POST['txtSoPin'];
	$mang = $_POST['select_method'];
	$id = $_POST['userid'];
	$name = $_POST['username'];
	if($mang==92){
			$ten = "Mobiphone";
		}
	else if($mang==107){
			$ten = "Viettel";
		}
	else $ten ="Vinaphone";
		//die($ten);
//die($mang);

$bk = new BKTransactionAPI("https://www.baokim.vn/services/transaction_api/init?wsdl");
$secure_pass = '9fae34dedc62b0d1';

//$bk = new BKTransactionAPI("http://sandbox.baokim.vn/services/transaction_api/init?wsdl");
//$secure_pass = 'f2d34bcfe3cd3b12';

$transaction_id = time();
/*
 * API nap the cao dien thoai cho Merchant
 * */
$info_topup = new TopupToMerchantRequest();

$info_topup->api_password = '3g9fbuo9ge289hf02f';
$info_topup->api_username = 'thuvientailieunet29';
$info_topup->card_id = $mang;
$info_topup->merchant_id = '3271';

//$info_topup->api_password = 'nhajben';
//$info_topup->api_username = 'nhajben';
//$info_topup->card_id = $mang;
//$info_topup->merchant_id = '576';

$info_topup->pin_field = $sopin;
$info_topup->seri_field = $seri;
$info_topup->transaction_id = $transaction_id;

$data_sign_array = (array)$info_topup;
ksort($data_sign_array);

$data_sign = md5($secure_pass . implode('', $data_sign_array));
$info_topup->data_sign = $data_sign;
//$test = new TopupToMerchantResponse();

//$test = $bk->DoTopupToMerchant($info_topup);
$test = $bk->DoTopupToMerchant($info_topup);
if($test["error_code"]==0){
$xu = $test["info_card"]/100;
    echo '<script>alert("Bạn đã thanh toán thành công thẻ cào '.$ten.' với mệnh giá '.$test["info_card"].'");</script>';
	$time = date("d/m/y  H:i:s"); 
	$money=$test["info_card"];
	$myStrSQL2="insert into napthe values ('','$name','$money','$time')";
	mysql_query($myStrSQL2);
	$total_results = mysql_result(mysql_query("SELECT money FROM user where userid='$id'"),0);
   // echo $xu;
	$Xu= $total_results+ $xu;
	$myStrSQL1="update user set money='$Xu' where userid='$id'";
     mysql_query($myStrSQL1);
	//die();
}
else {echo '<script>alert("Thông tin thẻ cào của bạn không hợp lệ (đã sử dụng) !");</script>';
 echo $test["error_code"];
}
//var_dump($test);
//echo '<br /><br />ID request:' . $transaction_id;
}

?>
<script type="text/javascript">
window.location = "http://thuvientailieu.net/napgold/";

	</script>
</body>
</html>