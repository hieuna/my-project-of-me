<?php
class contact  extends VS_Module_Base  
{	
	function __construct(){
		@eval(getGlobalVars());
		parent::__construct($oDb,$oSmarty);
		$this -> table = "tblcontact";
		$this->vsDb->setPrimaryKey($this->pk);
		$this -> vsDb -> setTable( $this->table );	
		
	}
	function run($task="")
	{
		switch( $task ){	
			case 'getcaptcha':
				echo $_SESSION['key_captcha'];
				break;		
			default:
				$this -> formContact();
				break;
		}
	}
	
	function getPageinfo(){
		global $oSmarty;
		
		$aPageinfo['title'] = $oSmarty->get_config_vars("title_contact");
		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_home");
		$aPageinfo['description'] = $oSmarty->get_config_vars("description_home");
		return $aPageinfo;
	}
	
	
	
	function formContact()
	{
		global $oSmarty,$oDb;
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			if(strcasecmp($_SESSION['key_captcha'], $_POST['txt_captcha']))
			{
				$oSmarty -> assign("msg", "Fail Security code !"); 	
			}	
			else
			{
				$headers = "MIME-Version: 1.0\r\n";
    			$headers .= "Content-type: text/html; charset=utf-8\r\n"; 
				$headers .= "From: {$_POST['email']}"."<br/>";							
				$content = "Tiêu đề: {$_POST['email']} <br> Noi dung: {$_POST['contactInput']}";				
				$subject = $_POST['fullname']." ".$oSmarty->get_config_vars('contact_receive_subject');
				$contacts = $oSmarty->get_config_vars('contact_receive_email');			
				$success = mail($contacts, $subject, $content, $headers);
				if($success==1)
					$oSmarty -> assign("msg", $oSmarty->get_config_vars('send_contact_succes'));
				else
					$oSmarty -> assign("msg", $oSmarty->get_config_vars('send_contact_failure'));			
			}	
		}
		$oSmarty -> display("frm_contact.tpl");
	}	
}
?>