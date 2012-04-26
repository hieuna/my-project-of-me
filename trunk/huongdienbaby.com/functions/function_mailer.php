<?
////////////////////////////////////////////////
// Ban khong thay doi cac dong sau:
function send_mailer($to,$title,$content,$from='',$id_error=""){

	if(file_exists("../classes/mailer/class.phpmailer.php")){
		require_once("../classes/mailer/class.phpmailer.php");
		require_once("../classes/database.php");
	}
	if(file_exists("../../classes/mailer/class.phpmailer.php")){
		require_once("../../classes/mailer/class.phpmailer.php");
		require_once("../../classes/database.php");
	}
	
	$mail_server	=	"";
	$user_name		=	"";
	$password		=	"";
	
	//select ra list_email
	//kiem tra neu chua co bang thi tao bang moi 
	$db_ex = new db_execute("CREATE TABLE IF NOT EXISTS `webmails` (
							  `mail_id` int(11) NOT NULL auto_increment,
							  `mail_title` varchar(255) default NULL,
							  `mail_to` varchar(255) default NULL,
							   `mail_from` varchar(255) default NULL,
							  `mail_content` text,
							  `mail_time` int(11) default '0',
							  `mail_status` int(11) default '0',
							  `lang_id` int(11) default '1',
							  PRIMARY KEY  (`mail_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8");
	unset($db_ex);
	
	//chèn nội dung vào bảng web mail
	require_once("../classes/generate_form.php");
	$myform = new generate_form();
	
	$_POST["mail_title"] 		= $title;
	$_POST["mail_to"] 			= $to;
	$_POST["mail_from"] 		= $from;
	$_POST["mail_content"] 		= str_replace('<br>',chr(13),$content);
	$_POST["mail_time"]			= time();
	
	$myform->add("mail_title","mail_title",0,0,"",0,"",0,"");
	$myform->add("mail_to","mail_to",0,0,"",0,"",0,"");
	$myform->add("mail_from","mail_from",0,0,"",0,"",0,"");
	$myform->add("mail_content","mail_content",0,0,"",0,"",0,"");
	$myform->add("mail_time","mail_time",1,0,0,0,"",0,"");
	
	$myform->addTable("webmails");
	$errorMsg 	= 	"";
	$errorMsg 	= 	$myform->checkdata();
	$sendok		=	0;
	if($errorMsg == ""){
		$db_ex 	= new db_execute_return();
		$sendok 	= $db_ex->db_execute($myform->generate_insert_SQL());
	}
	//Lấy account mail có lần gửi ít nhất	
		
	$mail_server 	= "smtp.gmail.com";
	$user_name		= "kythu.net@gmail.com";
	$password		= "tr01datm3nhm0ng";
	$db_email 		= new db_query("SELECT con_gmail_name,con_gmail_pass
									FROM configuration
									WHERE con_lang_id =1");	
	if($row=mysql_fetch_assoc($db_email->result)){
		$user_name		= $row["con_gmail_name"];
		$password		= $row["con_gmail_pass"];
	}									
	/*
	echo $mail_server . "<br>";
	echo $user_name . "<br>";
	echo $password . "<br>";
	*/
	
	//bắt đầu thực hiện gửi mail
	$mail 					= new PHPMailer();
	$mail->IsSMTP();
	$mail->Host     		= $mail_server;
	$mail->SMTPAuth 		= true;
	$mail->CharSet 			= "UTF-8";
	$mail->ContentType		= "text/html";
	
	
	////////////////////////////////////////////////
	// Ban hay sua cac thong tin sau cho phu hop
	
	$mail->Username = $user_name;				// SMTP username
	$mail->Password = $password; 				// SMTP password
	
	$mail->From     = $user_name;				// Email duoc gui tu???
	$mail->FromName = $user_name;		// Ten hom email duoc gui
	$to_array = split(",",$to);
	for ($i=0; $i<count($to_array); $i++){
		$mail->AddAddress($to_array[$i],"Admin");	 	// Dia chi email va ten nhan
	}
	//$mail->AddReplyTo("vatgia@truonghocso.com","Information");		// Dia chi email va ten gui lai
	
	$mail->IsHTML(true);						// Gui theo dang HTML
	
	$mail->Subject  =  $title;				// Chu de email
	$mail->Body     =  $content;			// Noi dung html
	
	//Nếu là google mail
	if ($mail->Host == "smtp.gmail.com"){
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Port       = 465;                   // set the SMTP port
		//$mail->MsgHTML($content);
	}
	
	if(!$mail->Send())
	{
		//Nếu không send được thì thử lại với account khác, chỉ thử lại max đến 2 lần là dừng lại
		//strlen($id_error) <= 3 - Ứng với 1 lần retry
		if (strlen($id_error) <= 3){
			///send_mailer($to, $title, $content, $id_error);
		}
		/*
		echo "Email chua duoc gui di! <p>";
		echo "Loi: " . $mail->ErrorInfo;
		*/
		//exit;
	}else{
		//trường hợp mail gửi thành công
		
		//echo $user_name . "<br>";
		//echo "Email da duoc gui!";
		return;
	}
}

//send_mailer("dinhtoan1905@gmail.com","chu de gui di","Cộng hòa xã hội chủ nghĩa Việt Nam <b>Xin chào các bạn</b><br><br>Cúc cu xin chào các bạn");
?>