<?php
class user extends VS_Module_Base {	

	function run($task)
	{	
	
		switch ($task)
		{
			case "login":
				$this->login();
				break;
			case "forgot_password":
				$this->forgotPassword();
				break;
			case "logout":
				$this->logout();
				break;
			case "register":
				$this->register();
				break;
			case 'doReset':
				$this -> doReset();
				break;
			case "edit_profile":
				$this->editProfile();
				break;
			case 'statistic':
				$this->doStatistic();
				break;
			case 'post':
				$this->postProfile();
				break;
			case 'post_recruitment':
				$this->postRecruitment();
				break;
			case 'default':
				$this->frmLogin();
				break;
			default:
				$this->login();
				break;
		}
	}
	
	/**
	 * @return int id of company type
	*/
	function getSuperAdminTypeID(){
		
		$tbl = "user_type"; 
		$sql = "SELECT id FROM {$tbl} WHERE name LIKE 'super admin'";
		$id = $oDb->getOne($sql);
	}
	
	function getPageinfo($task= "")
	{
		global $oSmarty;	
		
		switch ($task)
		{
			case "login":
				$aPageinfo=array('title'=>$oSmarty->get_config_vars("login"), 'keyword'=>'', 'description'=>'');
				$aPath = array(array("link"=> '', "path"=>$oSmarty->get_config_vars("login")));
				break;
			case "forgot_password":
				$aPageinfo=array('title'=>$oSmarty->get_config_vars("user_forgot_password"), 'keyword'=>'', 'description'=>'');
				$aPath = array(array("link"=> '', "path"=>$oSmarty->get_config_vars("user_forgot_password")));
				break;
			case "logout":
				$this->logout();
				break;
			case "register":
				$aPageinfo=array('title'=>$oSmarty->get_config_vars("user_register"), 'keyword'=>'', 'description'=>'');
				$aPath = array(array("link"=> '', "path"=>$oSmarty->get_config_vars("user_register")));
				break;
			case "edit_profile":
				$aPageinfo=array('title'=>$oSmarty->get_config_vars("user_edit_profile"), 'keyword'=>'', 'description'=>'');
				$aPath = array(array("link"=> '', "path"=>$oSmarty->get_config_vars("user_edit_profile")));
				break;
		}
		$oSmarty->assign('aPageinfo', $aPageinfo);
		$oSmarty->assign("aPath", $aPath);
	}
	
	function checkLogined(){
		if ( !$_SESSION["user_id"])
		{			
			$url = makeUrlFriendly(SITE_URL."index.php?mod=user&task=login");
			echo "<script language = 'javascript'>location.href = '".$url."'</script>";
			exit();
		}
	}
	
	function login()
	{
		global $oSmarty, $oDb;	

		if ( $_SESSION[$_SESSION["prefix_"]]["user_id"] != "")
		{
			
			$url = makeUrlFriendly(SITE_URL."index.php?mod=user&task=edit_profile");
			echo "<script language = 'javascript'>location.href = '".$url."'</script>";
			exit();
		}
		
		if($_SERVER['REQUEST_METHOD']=="POST")
		{
			
			$user= $oDb->getRow("select * from user where username='".$_POST[$_SESSION["prefix_"]."username"]."'");
			
			if(is_array($user))
			{
				if($user["password"]==md5($_POST[$_SESSION["prefix_"]."password"])){
					if($_GET['mod']=='admin'){
					}
					
					if($user["active"]=="1"){
						$_SESSION[$_SESSION["prefix_"]]["timelogin"]= mktime();
						$_SESSION[$_SESSION["prefix_"]]["user_id"]= $user["id"];
						$_SESSION[$_SESSION["prefix_"]]["user_id"]= $user["id"];
						$_SESSION[$_SESSION["prefix_"]]["username"]= $user["username"];
						$_SESSION[$_SESSION["prefix_"]]["useremail"]= $user["email"];
						$_SESSION[$_SESSION["prefix_"]]["user_type"] = $user["user_type_id"];						
						$_SESSION[$_SESSION["prefix_"]]['multilang'] =getConfig('multilanguage');
						$oDb->query("update user set status= '1' where username='".$_SESSION[$_SESSION["prefix_"]]["user_username"]."'");						
						$oSmarty->assign("error", $oSmarty->get_config_vars("login_success"));
						
							$trackUrl = SITE_URL."index.php?mod=admin&session=". encode(session_id());
						
						header("Location:{$url}{$trackUrl}");												
					}else{
						$oSmarty->assign("error", $oSmarty->get_config_vars("account_inactive"));
					}					
				}else{
					$oSmarty->assign("error", $oSmarty->get_config_vars("wrong_password"));
				}
			}else{
				$oSmarty->assign("error", $oSmarty->get_config_vars("wrong_username"));
			}
		}		
		//print_r($_SESSION);
			$oSmarty->display('login.tpl');
	}
	
	function getAdminTypeID(){
		global $oDb;
		$sql = "SELECT id FROM user_type WHERE name LIKE 'super admin'";
		return $oDb -> getOne($sql);
	}
	
	function forgotPassword()
	{
		global $oSmarty, $oDb;	
		if ( $_SESSION["user_id"] != "")
		{
			$url = makeUrlFriendly(SITE_URL."index.php?mod=user&task=edit_profile");
			echo "<script language = 'javascript'>location.href = '".$url."'</script>";
			exit();
		}
		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			$email = $_POST['tex_email'];
			$sQuery = "SELECT * FROM user WHERE email = '$email'";
			$row = $oDb -> getRow ( $sQuery );
			if ( count($row) == 0 )
			{
				$error = " Email is not exist. Check again ";
				$oSmarty->assign( "error", $error );
			}else 
			{
				$msg = $this -> resetPassword( $email, $row['password'] );
				$oSmarty->assign( "error", $msg );
			}
		}
		
		$oSmarty->display('forgot_password.tpl');
	}
	
	function resetPassword( $email, $password )
	{
		$new_password = $this -> randomPassword();	
		$code = md5( $password );
		$link_reset = SITE_URL."index.php?mod=user&task=doReset&email=".$email."&code=".$code."&tmp=".md5($new_password)."&ajax";
		$link_reset = makeUrlFriendly($link_reset);
		
		$subject = "Email reset Password ";
		
		$message = "Dear, This email has been sent to you in response to your request for the password to be reset  on your Account.<br>
						<br>
						To regain access to your account, please click on the following link:<br>
						<br>
						<a href='{$link_reset}' target='_blank'>{$link_reset}</a><br>
						<br>
						If successful you will be able to login using the following temporary password:<br>
						<br>
						Temporary password: {$new_password}<br>
						<br>
							If clicking the link above does not work, copy and paste the URL in a<br>
							new browser window instead.<br>
						<br>";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= "From: Chemtar <contact@chemtar.bsg>" . "\r\n";
		$result = @mail( $email, $subject, $message, $headers );
		if ( $result )
		{
			$msg = " <b style = 'color:blue'>Password have been sent to your email. Please check your email to reset password </b>";
		}else 
			$msg = " Can not send email . Try again ";
		
		return $msg;
	}
	
	function doReset()
	{
		global $oSmarty, $oDb;
		$email = $_GET['email'];
		$code = $_GET['code'];
		$sQuery = "SELECT * FROM user WHERE email = '$email'";	
		$row = $oDb -> getRow ( $sQuery );
		//echo md5($row['password']);
		if ( md5($row['password']) != $code )
		{
			$msg = "<span style = 'color:red'>Can not reset your password. Try again </span>";
			
		}else if ( md5($row['password']) == $code )
		{
			$query = "UPDATE user SET password = '".$_GET['tmp']."' WHERE email = '".$email."'";
			$oDb -> query ( $query );
			$link = SITE_URL."?mod=user&task=login";
			$msg = " Your password have been reset. Please login ";
			$continue = "<div>"."Please click <b><a style = 'color:#000000' href = '{$link}'>here</a></b> to login </div>";
		}		
		
		$oSmarty -> assign ( "msg", $msg );
		$oSmarty -> assign ( "continue", $continue );
		$oSmarty -> display( 'reset_password.tpl' );
	}
	
	function logout()
	{
		global $oSmarty, $oDb;	
		
		$oDb->query("update user set status= '0' where username='".$_SESSION["user_username"]."'");
		unset($_SESSION[$_SESSION["prefix_"]]);
		unset($_SESSION["user_id"]);
		unset($_SESSION["user_username"]);
		unset($_SESSION["user_email"]);
		$_SESSION[$_SESSION["prefix_"]]=array();
		$_SESSION= array();
		session_destroy();
		$oSmarty->assign("error", "logout_success");
		$url = SITE_URL;												
		header("Location:{$url}/admin");
	}
	
	function randomPassword() {
		
	    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
	    srand((double)microtime()*1000000);
	    $i = 0;
	    $pass = '' ;
	    while ($i <= 5) {
	        $num = rand() % 33;
	        $tmp = substr($chars, $num, 1);
	        $pass = $pass . $tmp;
	        $i++;
	    }
	    return $pass;
	}
	
	function doStatistic(){
		global $oDb, $oSmarty;
		$stbl = "tbl_user_online";
		// get User online
		$time = 10*60; //ten minutes
		$timenow = mktime();
		$timeafter = $timenow-$time;
		$sQuery = "select count(*) from {$stbl} where time > {$timeafter}";
		$aUserOnline = $oDb->getOne($sQuery);
		
		$sQuery = "select count(*) from {$stbl} where 1";
		$aUserVisited = $oDb->getOne($sQuery);		
		
		
		$oSmarty->assign('userOnline', $aUserOnline);
		$oSmarty->assign('userVisit', $aUserVisited);		
		$oSmarty->display('statistic.tpl');
	}	
}
?>