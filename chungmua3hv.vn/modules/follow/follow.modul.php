<?php

class follow extends VS_Module_Base

{	

	function __construct(){

			@eval(getGlobalVars()); 

			parent::__construct($oDb,$oSmarty);

			$this->table="tbl_shopping";

			$this->_prefix="Shopping_";

			$this->where=" where 1 ";

	}

	function run($task="")

	{	

		switch($task)

		{

			default: case "view":

				$this->viewItem(); break;

		}

	

	}

	function getPageinfo(){

		global $oSmarty;

		$aPageinfo['title'] ="KIỂM TRA ĐƠN HÀNG | ". $oSmarty->get_config_vars("title_home");

		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_home");

		$aPageinfo['description'] = $oSmarty->get_config_vars("description_home");

		if($_GET["task"]=='view'){

			$title=$this->getOne("select About_Title from tblabout {$this->where} and  {$this->_prefix}ID='".$_GET["id"]."'");

			$aPageinfo['title']=$title." | ".  $oSmarty->get_config_vars("title_about");

		}

		return $aPageinfo;

	}

	

	function viewItem(){

		if($_SERVER['REQUEST_METHOD']=='POST'){

			if($_POST["_follow"]){
				$_code = trim($_POST["_follow"]);
	
				$cart= $this->getRow("select * from {$this->table} where {$this->_prefix}Code='{$_code}'");
	
				if($cart){
	
				$product=  $this->getRow("select * from tblproduct where Product_ID='".$cart[$this->_prefix."ProductID"]."'");
	
				$this->assign("product",$product);
	
				$this->assign("cart",$cart);
	
				}else{
	
					$msg="Không tồn tài mã đơn hàng này. Xin bạn vui lòng thử lại.";
	
					$this->assign("msg",$msg);
	
				}
			}else{
				if($_POST["_email"]){
					if($_POST["_phone"]){
						
						$product=$this->getAll("select *,(select Product_Deal from tblproduct where Product_ID=Shopping_ProductID) as product_name from {$this->table} where {$this->_prefix}Email='".trim($_POST["_email"])."' and {$this->_prefix}Phone='".trim($_POST["_phone"])."'");
						$this->assign("productview",$product);
					}else{
						$msg="Bạn cần nhập đầy đủ cả email và số điện thoại.";
		
						$this->assign("msg",$msg);
					
					}
				
				}
			}

		}

			$this->display("form_follow.tpl");

	

	}

}

?>