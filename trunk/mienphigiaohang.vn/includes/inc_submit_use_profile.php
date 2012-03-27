<?php
$date				= date('Y-m-d H:i:s');
$user_id1 =$_SESSION['ses_userid'];
$select_user_info1 = new db_query(" SELECT * 
									 FROM users									 
									 WHERE  id = '".$user_id1."'");
$row_user_info1 = mysql_fetch_assoc($select_user_info1->result);
if(isset($_POST['form_bk']))
	{   		
//check tồn tại	
	$address = $_POST['address'];
	$num_email = 0 ;
	//check email
	$email = $_POST['email'];
	if($email != $row_user_info1['email']){

	$select_count_email = new db_query(" SELECT count(*) as count
										 FROM users									 
										 WHERE  email = '".$email."'");
	$row_count_email = mysql_fetch_assoc($select_count_email->result);
	$num_email = $row_count_email["count"];
	if($num_email != 0){
		echo '<script>alert ("Đăng ký không thành công '.$email.' đã có người dùng. Bạn hãy dùng một email khác để đăng kí!");</script>';	
	}
	}
    if($num_email == 0 ){
		$db_update = new db_execute("UPDATE users 
										  SET 
										  name =  '$_POST[fullname]', 
										  tel = '$_POST[phone]',
										  email = '$_POST[email]',
										  address = '$_POST[address]'
										  WHERE id = '".$_SESSION['ses_userid']."'");
		  unset($db_update);
		  
		/*$_SESSION['loged'] = 1;		
		$_SESSION['ses_userid'] = $last_id;
		$_SESSION['ses_username'] = $user_name;
		$_SESSION['ses_email'] = $email;	*/
		chuyen_trang("../deals/sua-thong-tin-ca-nhan-".$_SESSION['ses_username'].".html");
		}
	}
	
?>