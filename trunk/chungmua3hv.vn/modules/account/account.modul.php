<?php
class account extends VS_Module_Base
{
	function __construct(){
			@eval(getGlobalVars()); 
			parent::__construct($oDb,$oSmarty);
			$this->imagePath ="upload/avatar/";	
	}
	
	function run($task="")
	{	
		switch($task)
		{
			case "report":
					$this->frmReport();
					break;
			case "reg":
					$this->frmRegister();
					break;
			case "active":
					$this->frmActReg();
					break;
			case "doactive":
					$this->frmDoActive();
					break;
			case "passnew":
					$this->frmPassNew();
					break;
			case "doitc":
					$this->frmDoiTC();
					break;
			case "actscss":
					$this->frmActSuccess();
					break;
			case "sig":
					$this->frmSignin();
					break;
			case "out":
					$this->logout();
					break;
			case "editacc":
					checkLogin();
					$this->fromEditAcc();
					break;
			case "info":
					$this->infoAcc();
					break;
			case "order":
					$this->managerOrder();
					break;
			case "forgot":
					$this->formForgotPass();
					break;
			case "email":
					$this->showRegEmail();
					break;
			case "change":
					$this->changePass();
					break;
			case 'getcaptcha':
				echo $_SESSION['key_captcha'];
				break;
		}
	
	}
	
	function  getPageInfo($task){
		global $oSmarty;
		$aPageinfo['title'] = $oSmarty->get_config_vars("title_home");
		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_home");
		$aPageinfo['description'] = $oSmarty->get_config_vars("description_home");
		switch($task)
		{
			case "reg";	 $aPageinfo['title']=" Đăng ký tài khoản | ". $oSmarty->get_config_vars("title_home"); break;
			case "sig";	 $aPageinfo['title']=" Đăng nhập tài khoản | ". $oSmarty->get_config_vars("title_home"); break;
			case "change";	 $aPageinfo['title']=" Đổi mật khẩu | ". $oSmarty->get_config_vars("title_home"); break;
		}
		return $aPageinfo;
	}
	function logout()
	{
		 $_SESSION["member"]=array();
		 $_SESSION["_user"]=array();
		 $_SESSION['reg'] = array();
		 unset($_SESSION['reg']);
		 unset($_SESSION["member"]);	
		 unset($_SESSION["_user"]);	
		 $url= $_GET["url"];
				if($url)
					header("Location:".SITE_URL."thong-bao.html?url=$url&msg=".encode("Bạn đăng xuất thành công. Hệ thống sẽ tự chuyển tới trang bạn vừa xem..."));
				else
					header("Location:".SITE_URL."thong-bao.html?url=". encode(SITE_URL)."&msg=". encode("Bạn đăng xuất thành công. Hệ thống sẽ tự chuyển tới trang chủ..."));
			
		//header("Location:".SITE_URL."");
	}
	function ranstr($word_length)
	{
		$pool = '0123456789abcdefghijklmnopqrstuvwxyz';

		$str = '';
		for ($i = 0; $i < $word_length; $i++)
		{
			$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
		}

		return $str;
	}
	function infoAcc()
	{
		global $oSmarty,$oDb;
		$oSmarty->display("viewInfoAcc.tpl");
	}
	function fromEditAcc()
	{
		global $oSmarty,$oDb;
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$name = $_POST['frmName'];
			$addres = $_POST['frmAddress'];
			$gender = $_POST['frmGender'];
			$email = $_POST['frmEmail'];
			$phone = $_POST['frmPhone'];
/*			$mid = $_POST['memid'];
			$url = $_POST['url'];
			if($_FILES['UploadAvatar']['name']){
				$this->unlinkPhoto($_POST['oldPhoto']);
				$uploadFile = $this->uploadPhoto();
				if($uploadFile=='none' || $uploadFile == '') $avatar = "";
				else
					$avatar = $uploadFile;
				$data =	array(
						'Member_Name' 	=>	$name,
						'Member_Address'	=>	$addres,
						'Member_Email' => $email,
						'Member_Gender' => $gender,
						'Member_Photo' => $uploadFile,
						'Member_Phone' => $phone
					);
			}
			else
			{
				$data =	array(
						'Member_Name' 	=>	$name,
						'Member_Address'	=>	$addres,
						'Member_Email' => $email,
						'Member_Gender' => $gender,
						'Member_Phone' => $phone
					);
			}
*/			
			
			
			$aData =	array(
						'Member_Name' 	=>	$name,
						'Member_Address'	=>	$addres,
						'Member_Email' => $email,
						'Member_Gender' => $gender,
						'Member_Phone' => $phone
					);
			$oDb->autoExecute("tblmember", $aData,DB_AUTOQUERY_UPDATE, "Member_ID='".$_SESSION["_user"]["ID"]."'"); 
			$msg= "Sửa thông tin thành công!";
			
		}else{
			$msg="";
		}
		$sql = $oDb->getRow("select * from tblmember where Member_ID='".$_SESSION["_user"]["ID"]."'");
		$oSmarty->assign('msg',$msg);
		$oSmarty->assign('accinfo',$sql);
		$oSmarty->display("accInfo.tpl");
	}
	function unlinkPhoto( $sImage )
	{
		if( $sImage )
		{
			@unlink(SITE_DIR.$this->imagePath."/{$sImage}");
			//@unlink(SITE_DIR.$this->imagePath."/thumb/{$sImage}");
		}
	}

	function changePass()
	{
		global $oSmarty,$oDb;
		$chkinsert = 'true';
		$id = $_SESSION['member']['id'];
		$pass = $_POST['passnew'];
		$passconf = $_POST['passconf'];
		$url = $_POST['url'];
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$password= trim($_POST["frmPassword"]);	
			$passwordNew= trim($_POST["frmPasswordNew"]);	
			$passwordNewConfirm= trim($_POST["frmPasswordNewConfirm"]);	
			if($passwordNew==$passwordNewConfirm){
				$__password = md5($passwordNewConfirm);
				$this->query("update tblmember set Member_Password='{$__password}' where Member_ID='".$_SESSION["_user"]["ID"]."'");
				$msg="Bạn đã đổi mật khẩu thành công.";
			}else{
				$msg="Đổi mật khẩu không thành công. Xin thử lại";
			}
		}
		$this->assign("msg",$msg);
		$oSmarty->display("viewChange.tpl");	
	}
	function frmSignin()
	{
		global $oSmarty,$oDb;
		if(isset($_SESSION['member'])){
			if($_GET["url"])
				header("Location:".decode($_GET["url"]));
			else
				header("Location:".SITE_URL);
		}
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$email = trim($_POST['email']);
			$url= $_POST["url"];
			$nochange = trim($_POST['password']);
			$pass = md5(trim($_POST['password']));
			$sql = $oDb->getRow("select * from tblmember where Member_Email='{$email}' and Member_Password='{$pass}' and Member_Status='1'");
			if(count($sql) > 0)
			{
				
				$_SESSION['member']['name'] = $_SESSION['_user']['Name'] = $sql['Member_Name'];
				$_SESSION['member']['email'] = $sql['Member_Email'];
				$_SESSION['member']['id'] = $_SESSION['_user']['ID'] = $sql['Member_ID'];
				$_SESSION['member']['phone'] = $sql['Member_Phone'];
				$_SESSION['member']['avatar'] = $sql['Member_Photo'];
				$_SESSION['member']['address'] = $sql['Member_Address'];
				if($_POST['customer_save_login'] == TRUE)
				{
					setcookie("logemail", $email, time()+86400);
					setcookie("logpass", $nochange, time()+86400);
				}
				if($url)
					header("Location:".SITE_URL."thong-bao.html?url=$url&msg=".encode("Đăng nhập thành công. Hệ thống sẽ tự chuyển tới trang bạn vừa xem..."));
				else
					header("Location:".SITE_URL."thong-bao.html?url=". encode(SITE_URL)."&msg=". encode("Đăng nhập thành công. Hệ thống sẽ tự chuyển tới trang chủ..."));
			}
			else
			{
				$logerror = 'Đăng nhập không thành công! Bạn vui lòng nhập lại thông tin chính xác!';
				$oSmarty->assign('logerror',$logerror);
				if($_POST["logintype"]==1){
					if($url)
						header("Location:".SITE_URL."dang-nhap.html?url=".$url);
					else
						header("Location:".SITE_URL);
				}
		}	
		}
		$oSmarty->display("signin.tpl");	
	}
	function frmRegister()
	{
		global $oSmarty,$oDb;
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$name = trim($_POST['fullname']);
			$pass = trim($_POST['password']);
			$email = trim($_POST['email']);
			$passconf = trim($_POST['passconf']);
			$phone = trim($_POST['phone']);	
			$term = $_POST['termofuse'];
			$security = trim($_POST['security']);
				
			$_SESSION['reg']['name'] = $name;
			$_SESSION['reg']['pass'] = $pass;
			$_SESSION['reg']['email'] = $email;
			$error = "";			
			if($security != $_SESSION['key_captcha'])
			{
				$error.= " <p><b>Lỗi:</b> Bạn nhập mã xác nhận không đúng.</p>";	
			}
			if($error != '')
			{
				$oSmarty->assign('error',$error);
			}
			else
			{
				$sql = $oDb->getRow("select * from tblmember where Member_Email='{$email}'");
				$time =  mktime(date("h"),date("i"),date("s"),date("n"),date("j"),date("Y"));
				if(count($sql) > 0)
				{
					$chktime = $time - $sql['Member_time_limit'];
					$chk = date("H",$chktime);
					if($chk > 24)
					{
						$oDb->query("DELETE FROM tblmember WHERE Member_Email='{$email}' and Member_Status='0'");
					}
					else
					{
						$error.= " <p><b>Lỗi:</b> Email này đã được đăng ký. Bạn vui lòng nhập email khác!</p>";
					}
					$oSmarty->assign('error',$error);
				}
				else
				{
					
					$data =	array(
								'Member_Name'	=>	$name,
								'Member_Email' 	=>	$email,
								'Member_Password'	=>	md5($pass),
								'Member_Phone'	=>	$phone,
								'Member_time_limit' => $time,
								'Member_Status' => '0'
							);
					$oDb->autoExecute("tblmember", $data,DB_AUTOQUERY_INSERT);
					$code = md5($pass);
					$tmp = md5($time);
					$link = SITE_URL."kich-hoat-thanh-vien.html?email=".$email."&code=".$code."&tmp=".$tmp;
					$this->sendMail('reg','Kích hoạt tài khoản - chungmua3hv.vn',$_SESSION['reg']['email'],$link);
					//$_SESSION['namelogin'] = $name;
					//$cvalue = '1';
					//setcookie("regsucess", $cvalue, time()+5);
					header("Location:".SITE_URL."?mod=account&task=active");
				}
					
			}
		}
		$oSmarty->display("register.tpl");	
	}
	function frmActReg()
	{
		global $oSmarty,$oDb; 
		$oSmarty->display("act_register.tpl");	
	}
	function frmDoActive()
	{
		global $oSmarty,$oDb; 
		$code = $_GET['code'];
		$email = $_GET['email'];
		$time = $_GET['tmp'];
		
		$sql = $oDb->getRow("select * from tblmember where Member_Email='{$email}' and Member_Password='{$code}'"); 
		if(count($sql) > 0)
		{
			$tmp = md5($sql['Member_time_limit']);
			$tmp_nochange = $sql['Member_time_limit'];
			$hour = mktime() - $sql['Member_time_limit'];	
			$chk = date("H",$hour);
			if($sql['Member_Status']=='1')
			{
				$error = 'Tài khoản đã được kích hoạt.';
				$oSmarty->assign('error',$error);
			}
			else
			{ 
				if(($tmp == $time) && ($chk < 24))
				{
					$_SESSION['succes']['email'] =  $email;
					$arr = array(
						'Member_Status' => 1,
					);
					$res = $oDb->autoExecute('tblmember', $arr,DB_AUTOQUERY_UPDATE, "Member_Email = '{$email}'");
					header("Location:".SITE_URL."?mod=account&task=actscss");
				}
				else
				{
						$error = 'Email này đã quá hạn để kích hoạt! Bạn vui lòng đăng ký lại thông tin!';
						$oDb->query("DELETE FROM tblmember WHERE Member_Email='{$email}' and Member_Status='0' and 	Member_time_limit='{$tmp_nochange}' ");
						$oSmarty->assign('error',$error);
				}
			}
		}
		else
		{
			$error = 'Nội dung này không tồn tại';
			$oSmarty->assign('error',$error);
		}
		$oSmarty->display("active.tpl");	
	}
	function formForgotPass(){
		global $oDb;
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$email = $_POST['email'];
			$sqlQuery = $this->getRow("select * from tblmember where Member_Email='{$email}' and Member_Status='1'");
			if(count($sqlQuery) > 0)
			{
				$logerror = 'Mật khẩu đã được gửi về mail của bạn.';
				//$ps = $this->ranstr(8);
				$resend = md5($email.$sqlQuery['Member_time_limit'].mktime()).$sqlQuery['Member_Password'];
				$arr = array(
						'Member_Active_Code' => $resend
				);							
				$res = $oDb->autoExecute('tblmember', $arr,DB_AUTOQUERY_UPDATE, "Member_Email = '{$email}'");
				$link = SITE_URL."lay-lai-mat-khau.html?email=".$email."&resend=".$resend;
				$this->sendMail('forgot','Quên mật khẩu đăng nhập trên chungmua3hv.vn',$email,$link,$ps);
				redirect('quen-mat-khau.html',3);
			}
			else
			{
				$logerror = 'Email này không tồn tại! Bạn vui lòng nhập chính xác email để nhận lại tài khoản!';				
			}
			$this->assign('logerror',$logerror);
		}
		$this->display("form_forgot_password.tpl");
	}
	function frmReport()
	{
		$this->display("frm_report.tpl");
	}
	function frmActSuccess()
	{
		global $oSmarty,$oDb; 
		redirect(SITE_URL,3);
		$oSmarty->display("active_success.tpl");
	}
	function frmPassNew()
	{
		global $oDb;
		$email = $_GET['email'];
		$resend = $_GET['resend'];
		$sql = $this->getRow("select * from tblmember where Member_Email='{$email}' and Member_Active_Code = '{$resend}'");
		if(count($sql) > 0)
		{
			if($_SERVER['REQUEST_METHOD']=='POST')
			{
				$pass = $_POST['chpass'];
				$arr = array(
						'Member_Password' => md5($pass),
						'Member_Active_Code' => ''
				);							
				$res = $oDb->autoExecute('tblmember', $arr,DB_AUTOQUERY_UPDATE, "Member_Email = '{$email}'");
				$logerror = 'Đổi mật khẩu thành công.';
				$this->assign('logerror',$logerror);
				//redirect(SITE_URL,3);
			}
		}
		else
		{
			$logerror = 'Có lỗi xảy ra! Hệ thống dừng hỗ trợ mật khẩu.';
			$this->assign('logerror',$logerror);			
		}
		$this->display("form_pass_new.tpl");
	}
	function frmDoiTC()
	{
		$this->display("form_doitc.tpl");
	}
}
?>