<?php
if(isset($_POST['form_login']))
	{   		
//check tồn tại	
	$user_name = $_POST['user_name'];
	$pass = $_POST['pass'];
	$pass_md5 = md5(md5($pass));
	//die($user_name.md5($pass));
	$select_count_user = new db_query(" SELECT count(*) as count
									 FROM users									 
									 WHERE  username = '$user_name' AND password = '".$pass_md5."'");
	//die($select_count_user);							 
	$row_count_user = mysql_fetch_assoc($select_count_user->result);
	$i = $row_count_user["count"];
		//die($i);
    if( $i != 0 ){
		
		// Make a verification
		$select_user = new db_query(" SELECT *
									 FROM users									 
									 WHERE  username = '$user_name' AND password = '".$pass_md5."'");
		$row_user= mysql_fetch_assoc($select_user->result);
		// Register the session
		//session_regenerate_id();
		
		$_SESSION['loged'] = 1;		
		$_SESSION['ses_userid'] = $row_user['id'];
		$_SESSION['ses_username'] = $row_user['username'];
		$_SESSION['ses_email'] = $row_user['email'];
		$_SESSION['ses_phone'] = $row_user['tel'];
		//session_write_close();		
		//$request_url = '../deals/register_success.php';
		chuyen_trang("../deals/dang-nhap-thanh-cong.html");
		//header('Location:' . $request_url);		
		}
	else{
		echo '<script>alert ("Đăng nhập không thành công ! Bạn không thể đăng nhập , hãy liên hệ với Mienphigiaohang.vn để được trợ giúp!");</script>';
		}
	}
	
?>