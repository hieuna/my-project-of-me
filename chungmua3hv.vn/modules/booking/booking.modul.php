<?php
class booking extends VS_Module_Base
{	
	function __construct(){
			@eval(getGlobalVars()); 
			parent::__construct($oDb,$oSmarty);
			$this->table="tbl_shopping_cart_info";
			$this->type='tour';
			$this->_prefix="Product_";
			$this->where=" where {$this->_prefix}LangID='".$_SESSION["lang_id"]."' ";
	}
	function run($task="")
	{	
		switch($task)
		{
			case "finish":
				$this->finishBooking(intval($_GET["success"])); break;
			case "add":
				$this->addBooking(intval($_GET["ID"])); break;
			default: case "list":
				$this->showBooking($_GET["gid"]); break;
		}
	
	}
	function getPageinfo($task){
		global $oSmarty;
		$aPageinfo['title'] = $oSmarty->get_config_vars("title_home");
		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_home");
		$aPageinfo['description'] = $oSmarty->get_config_vars("description_home");
		if($task=='view'){
			$title= $this->getOne("select  {$this->_prefix}Name from {$this->table} {$this->where} and {$this->_prefix}ID='".intval($_GET["id"])."'");
			$aPageinfo['title']="{$title} | ".$aPageinfo['title'];
		}
		return $aPageinfo;
	}
	function addBooking($id){
		$product= $this->getRow("select * from tblproduct where Product_ID='{$id}' and Product_Status='1'");
		$this->assign("product",$product);
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if($_SESSION['security_code'] == $_POST['txtSecurity'] && !empty($_SESSION['security_code'] )){
			//print_r($_POST);
					$cart_info= $this->htmlCart($_POST,$product);
		//			print_r($cart_info);
					$aData= array(
						"name"=> $_POST["txtName"]  ,
						"email"=> $_POST["txtEmail"]  ,
						"address"=> $_POST["txtAddress"]  ,
						"tell"=> $_POST["txtPhone"]  ,
						"tex_info"=> $_POST["txtRequest"]  ,
						"info_cart"=> $cart_info,
						"type"=> $product["Product_Type"]
					);
				$this->vsDb->setTable($this->table);	
				$this->vsDb->setPrimaryKey("id");
				$this->vsDb->insert($aData);
				$msg = $this->sendMail($cart_info,$aData["email"]);
				if($msg=='1'){
					redirect(SITE_URL.$_SESSION["lang"]."/booking?task=finish&success=1"); 
					exit();
				}else
				if($msg=='0')
					$this->assign("msg",$this->get_config_vars('send_contact_failure'));
					
			}else{
					$this->assign("msg",$this->get_config_vars('security_incorrect'));
			}
		}
		$this->display("addBook.tpl");
	}
	function sendMail($txt_content,$email){
		$headers  = 'MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-type: text/html;charset=utf-8'."\r\n";			
		$headers .= 'From: '.$email."\r\n";			
		/*'.$_POST['txt_name'].' */
		$content="<p>Cám ơn bạn đã đăng ký dịch vụ của Annam travel!</p>
<p>Chúng tôi gửi email này để thông báo chúng tôi đã nhận được đơn hàng của bạn và chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất!</p>
<p>&nbsp;</p>
";
		$content .= stripslashes($txt_content);
		$content.="<p>Mọi thông tin thắc mắc xin vui lòng liên hệ:</p>
<p>Công ty Du lịch và Thương mại ANNAM</p>
<p> Địa chỉ giao dịch: số 8 ngõ 68/39 Cầu Giấy, Hà Nội</p>
<p> Điện thoại: +84-4-3 7676423</p>
<p> Fax:          +84-4-3 7676424</p>
<p> Email:      <a href=\"mailto:info@annamtravel.com\"><u>info@annamtravel.com</u></a></p>
<p> Website:     www.annamtravel.com.vn</p>
";
		$subject = $this->get_config_vars('subject_email_contact');
		
		$to = $email.",". $this->get_config_vars('sales_email');
		
		$success = @mail($to, $subject, $content, $headers);
		if($success!=1)
			return 0;
		else
			return 1;
	
	}
	function finishBooking($id){
			$this->assign("id",$id);
			$this->display("bookFinish.tpl");
	}
	function htmlCart($post,$product){
		if($post){
//			print_r($_POST);
			$this->assign("post",$post);
			$this->assign("product",$product);
			$content= $this->fetch("bookHtml.tpl");
			return $content;
		}
	
	}
}
?>