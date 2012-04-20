<?php
class email extends VS_Module_Base
{	
	function __construct(){
			@eval(getGlobalVars()); 
			parent::__construct($oDb,$oSmarty);
			$this->table="tbl_notice_deals";
			$this->_prefix="User_";
			$this->where=" where {$this->_prefix}LangID='".$_SESSION["lang_id"]."' ";
	}
	function run($task="")
	{	
		switch($task)
		{
			case "request":
				$this->requestFRM(); break;
			case "add":
				$this->addEmail(); break;
			case "view":
				$this->viewAbout(intval($_GET["id"])); break;
			case "home":
				$this->homeAbout(); break;
			default: case "list":
				$this->listAbout(); break;
		}
	
	}
	function getPageinfo(){
		global $oSmarty;
		$aPageinfo['title'] = $oSmarty->get_config_vars("title_about");
		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_home");
		$aPageinfo['description'] = $oSmarty->get_config_vars("description_home");
		if($_GET["task"]=='view'){
			$title=$this->getOne("select About_Title from tblabout {$this->where} and  {$this->_prefix}ID='".$_GET["id"]."'");
			$aPageinfo['title']=$title." | ".  $oSmarty->get_config_vars("title_about");
		}
		return $aPageinfo;
	}
	
	function addEmail(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$email= trim($_POST["email"]);
			$_check = $this->getOne("select User_email from {$this->table} where {$this->_prefix}Email ='{$email}'");
			if(!$_check){
				$this->query("insert into tbl_notice_deals (User_email,User_Active) values ('{$email}','1')");
				$msg="Bạn đã đăng ký nhận khuyến mại thành công.";
			}
			else{
				$msg="Email này đã được đăng ký rồi.";
			}
		}
		$this->assign("msg",$msg);
		$this->display("addEmail.tpl");
	}
	function viewAbout($id){
		$about= $this->getRow("select * from {$this->table} {$this->where} and {$this->_prefix}ID='{$id}'");
		$this->assign("about_item",$about);
		$other= $this->getAll("select  {$this->_prefix}ID, {$this->_prefix}Title,  {$this->_prefix}CreateDate 
		from {$this->table} {$this->where} and {$this->_prefix}ID <> '{$id}' order by About_Order,About_ID limit 10");
		$this->assign("about_other",$other);
		$this->display("about_detail.tpl");
	
	}
	function homeAbout(){
		$about= $this->getRow("select * from {$this->table} {$this->where} and {$this->_prefix}Populer='1' and {$this->_prefix}Status='1'  limit 1");
		$this->assign("about_item_home",$about);
		$this->display("about_home.tpl");
	
	}
	function listAbout(){
		$about= $this->getAll("select * from {$this->table} {$this->where} and {$this->_prefix}Status='1' order by {$this->_prefix}Order asc");
		if(count($about)==1){
			redirect(SITE_URL.$_SESSION["lang"]."?mod=about&task=view&id=".$about[0]["About_ID"]); exit();
		}
		$this->assign("about_item_list",$about);
		$this->display("about_list.tpl");
	
	}
	
	function requestFRM(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
				$msg="Xin cảm ơn góp ý của bạn! Chúng tôi sẽ phản hồi lại góp ý của bạn trong thời gian sớm nhất!";
		
		}
	  $product = $this->getRow("select Product_Name,Product_ID from tblproduct where Product_ID='".$_GET["id"]."'");
		$this->assign("msg",$msg);
		$this->assign("productname",$product);
		$this->display("email_form_request.tpl");
	}
}
?>