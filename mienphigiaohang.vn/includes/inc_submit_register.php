<?php
$date				= date('Y-m-d H:i:s');
if(isset($_POST['form_bk']))
	{   
		$email_sent = 1;
		if(isset($_POST['email_sent']))
		{ $email_sent = $_POST['email_sent'];}
		
		//die($email_sent);
		
//check tồn tại	
	$user_name = $_POST['user_name'];
	
	$select_count = new db_query(" SELECT count(*) as count
									 FROM users									 
									 WHERE  username = '".$user_name."'");
	$row_count = mysql_fetch_assoc($select_count->result);
	$i = $row_count["count"];
	if($i != 0){
		echo '<script>alert ("Đăng ký không thành công ! Rất tiếc, tài khoản '.$user_name.' đã có người dùng! Bạn hãy chọn một tên khác!");</script>';
		}
	//check email
	$email = $_POST['email'];

	$select_count_email = new db_query(" SELECT count(*) as count
										 FROM users									 
										 WHERE  email = '".$email."'");
	$row_count_email = mysql_fetch_assoc($select_count_email->result);
	$num_email = $row_count_email["count"];
	if($num_email != 0){
		echo '<script>alert ("Đăng ký không thành công '.$email.' đã có người dùng. Bạn hãy dùng một email khác để đăng kí!");</script>';	
	}
    if( $i == 0 && $num_email == 0 ){
		//die('chó');
		$pass = md5(md5($_POST['pass']));					
		$db_insert	       = new db_execute_return();
		$last_id		   = $db_insert->db_execute("
													INSERT INTO `users` 
													(														
														`name` ,														
														`tel` ,
														`email` ,
														`username` ,
														`password` ,
														`date` ,
														`email_sent` ,														
														`hide`
													)
													VALUES
													(														
														'$_POST[fullname]', 														
														'$_POST[phone]', 
														'$_POST[email]',
														'$_POST[user_name]', 
														'$pass',
														'$date', 
														'$email_sent',														
														'1'
													);
												  "); 
		unset($db_insert);
		$_SESSION['loged'] = 1;		
		$_SESSION['ses_userid'] = $last_id;
		$_SESSION['ses_username'] = $user_name;
		$_SESSION['ses_email'] = $email;	
		//$request_url = '../deals/register_success.php';
		chuyen_trang("../deals/dang-ky-thanh-cong.html");
		//header('Location:' . $request_url);		
		}
	}
	
?>