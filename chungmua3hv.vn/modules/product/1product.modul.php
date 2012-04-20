<?php

class product extends VS_Module_Base

{	

	function __construct(){

			@eval(getGlobalVars()); 

			parent::__construct($oDb,$oSmarty);

			$this->table="tblproduct";

			$this->type='product';

			$this->_prefix="Product_";

			$timemow= mktime();

			$this->where=" where {$this->_prefix}Status='1' and  {$this->_prefix}Sold !='1'  and {$this->_prefix}EndDate >= '{$timemow}' ";

			

	}

	function run($task="")

	{	

		if(isset($_SESSION["ppcity"])){

			$caID = $this->getOne("select Group_ID from tblgroup where Group_Mark = '".$_SESSION["ppcity"]."'");

			$this->where.=" and   ({$this->_prefix}DestinationID= '".$caID."' or {$this->_prefix}DestinationID ='' or {$this->_prefix}DestinationID is null)";

		}

		switch($task)

		{

			case "menu":

				$this->showMenu(); break;

			case "category":

				$this->showGetCategory($_GET["DID"]); break;

			case "new":

				$this->showNew(); break;

			case "promotion":

				$this->showPromotion(); break;

			case "sold":

				$this->soldItem(); break;

			case "view":

				$this->viewItem(intval($_GET["ID"])); break;

			case "home":

				$this->homeItem(); break;

			case "search":

				$this->listSearch(); break;

			case "discount":

				$this->listDiscount(); break;

			default: case "list": 

				$this->listItem($_GET["CID"]); break;

		}

	

	}

	function getPageinfo($task){

		global $oSmarty;

		$aPageinfo['title'] = $oSmarty->get_config_vars("title_home");

		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_home");

		$aPageinfo['description'] = $oSmarty->get_config_vars("description_home");

		switch($task)

		{

			case "view";

				$title= $this->getOne("select  {$this->_prefix}Name from {$this->table}  where {$this->_prefix}Status='1' and {$this->_prefix}ID='".intval($_GET["ID"])."'");

				$aPageinfo['title']="{$title} | ".$aPageinfo['title'];

			

			break;

			case "sold":

				$aPageinfo['title']="Sản phẩm đã bán | ".$aPageinfo['title'];

			break;

		}

		if($_GET["CID"] || $_GET["DID"]){

			$title= $this->getOne("select Group_Name from tblgroup where Group_Mark='".$_GET["CID"]."' or  Group_Mark='".$_GET["DID"]."'");		

			$aPageinfo['title']="{$title} | ".$aPageinfo['title'];

		}

		return $aPageinfo;

	}

	

	function showMenu(){

		$menu=$this->getAll("select Group_ID,Group_Name 

		from tblgroup 

		 where Group_LangID='".$_SESSION["lang_id"]."' and  Group_Status='1' and Group_Type='{$this->type}' and Group_ParentID='0'  order by Group_Order");

		 if($menu)

		 	foreach($menu as $key => $value){

				$menu[$key]["sub"]=$this->getAll("select Group_ID,Group_Name 

		from tblgroup 

		 where Group_LangID='".$_SESSION["lang_id"]."' and  Group_Status='1' and Group_Type='{$this->type}' and Group_ParentID='".$value["Group_ID"]."'  order by Group_Order");

			}

		$this->assign("product_menu",$menu);

		$this->display("product_menu.tpl");

	}

	function viewItem($id){

		$this->updateNumberView($id);

		$comment = $this->getOne("select count(Comment_ID) from tblcomment where Comment_ProductID='{$id}'");

		$product= $this->getRow("select *,(select Group_Name from tblgroup where Group_ID= {$this->_prefix}DestinationID) as DestinationID from {$this->table} where {$this->_prefix}Status='1' and {$this->_prefix}ID='{$id}'");

		$note= $this->getRow("select * from tblcontent where Content_ID='7' and Content_Status='1'");

		$this->assign("note",$note);

		$product["comment"]= $comment;

		$this->assign("product_item",$product);

		$this->display("product_detail.tpl");

	

	}

	function updateNumberView($id){

		$this->query("update tblproduct set Product_NumberView=Product_NumberView+1 {$this->where} and  Product_ID='{$id}'");

	}

	function homeItem(){

		$product= $this->getAll("select *,(select Group_Name from tblgroup where Group_ID= {$this->_prefix}DestinationID) as DestinationID from tblproduct {$this->where} and ({$this->_prefix}Hot= '' or  {$this->_prefix}Hot is null)  order by {$this->_prefix}ID desc limit 30");

		

		$this->assign("product_item_home",$product);

		$this->display("product_home.tpl");

	

	}

	function soldItem(){

		

	 	$sql="select *,(select Group_Name from tblgroup where Group_ID = {$this->_prefix}DestinationID) as DestinationID from {$this->table} where {$this->_prefix}Status='1' and {$this->_prefix}Sold= '1'";

		$iTotalRecord = count($this->getAll($sql));

		

		include_once("./lib/paging/paging.php");

		$iCurrentPage = (isset($_GET['page'])&&$_GET['page']>0)?$_GET['page']:1;

		$iPerpage = 10;

		$sLimit = " LIMIT ".($iCurrentPage-1)*$iPerpage.",".$iPerpage; 

		$sUrlPath="san-pham-da-ban.html?page={i}";

		$oPaging = new paging($iPerpage, $iTotalRecord, $iCurrentPage, $sUrlPath);

		$sPaging = $oPaging->getStringPaging();

		$product= $this->getAll($sql.$sOrder.$sLimit);	

		$this->assign("sPaging", $sPaging);

		$this->assign("product_item_sold",$product);

		$this->display("product_sold.tpl");

	

	}

	function showNew(){

		$product= $this->getAll("select * from {$this->table} {$this->where} and  {$this->_prefix}Status='1' and {$this->_prefix}New='1' order by   {$this->_prefix}ID desc");

		$this->assign("product_item_new",$product);

		$this->display("product_home_new.tpl");

	}

	function listDiscount()

	{

		$time = mktime();

		$sql = $this->getAll("select *,(select Group_Name from tblgroup where Group_ID= {$this->_prefix}DestinationID) as DestinationID from tblproduct where Product_Status='1' and Product_Hot='1' limit 30");

		$this->assign("discount",$sql);

		$this->display("displayDiscount.tpl");

	}

	function showPromotion(){

		$product= $this->getAll("select * from {$this->table} {$this->where} and  {$this->_prefix}Status='1' and {$this->_prefix}Promotion='1' order by   {$this->_prefix}ID desc");

		$this->assign("product_item_promotion",$product);

		$this->display("product_home_promotion.tpl");

	}

	

	function listItem($gid='0'){

		

		if($gid){

			$category = $this->getRow("select * from tblgroup where Group_Mark='{$gid}'");

			//$_SESSION["ppcity"]= $gid;

			// print_r($_COOKIE);

		}

		

	 	$sql="select *,(select Group_Name from tblgroup where Group_ID= {$this->_prefix}DestinationID) as DestinationID from {$this->table}  {$this->where} ";
		$sOrder=" order by {$this->_prefix}DestinationID desc ";
		$iTotalRecord = count($this->getAll($sql));

		include_once("./lib/paging/paging.php");

		$iCurrentPage = (isset($_GET['page'])&&$_GET['page']>0)?$_GET['page']:1;

		$iPerpage = 15;

		$sLimit = " LIMIT ".($iCurrentPage-1)*$iPerpage.",".$iPerpage; 

		$sUrlPath="?page={i}";

		$oPaging = new paging($iPerpage, $iTotalRecord, $iCurrentPage, $sUrlPath);

		$sPaging = $oPaging->getStringPaging();

		$product= $this->getAll($sql.$sOrder.$sLimit);	

		$this->assign("sPaging", $sPaging);

		$this->assign("product_item_list",$product);

		$this->display("product_list.tpl");

	

	}

	function showGetCategory($gid='0'){

		

		if($gid){

			$category = $this->getRow("select * from tblgroup where Group_Mark='{$gid}'");

		}

		

	 	$sql="select *,(select Group_Name from tblgroup where Group_ID= {$this->_prefix}DestinationID) as DestinationID from {$this->table}  {$this->where} and {$this->_prefix}GroupID= '".$category["Group_ID"]."'";

		$iTotalRecord = count($this->getAll($sql));

		include_once("./lib/paging/paging.php");

		$iCurrentPage = (isset($_GET['page'])&&$_GET['page']>0)?$_GET['page']:1;

		$iPerpage = 15;

		$sLimit = " LIMIT ".($iCurrentPage-1)*$iPerpage.",".$iPerpage; 

		$sUrlPath="?page={i}";

		$oPaging = new paging($iPerpage, $iTotalRecord, $iCurrentPage, $sUrlPath);

		$sPaging = $oPaging->getStringPaging();

		$product= $this->getAll($sql.$sOrder.$sLimit);	

		$this->assign("sPaging", $sPaging);

		$this->assign("product_item_list",$product);

		$this->display("product_list.tpl");

	

	}

	function listSearch(){

		$where="  {$this->where} and 

		{$this->_prefix}Status='1' ";

		if($_GET["keyword"]){

			$where.=" and {$this->_prefix}Name like '%".trim($_GET["keyword"])."%' ";

		}

		$order= " order by {$this->_prefix}ID asc ";

		if($_GET["order"]=='price-desc'){

			$order=" order by Product_Price desc ";

		}

		if($_GET["order"]=='price-asc'){

			$order=" order by Product_Price asc ";

		}

		if($_GET["order"]=='hot'){

			$order=" order by Product_Hot desc ";

		}

		if($_GET["order"]=='new'){

			$order=" order by Product_New desc ";

		}

		$sql="select * from {$this->table}  {$where} {$order}";

			

		$iTotalRecord = count($this->getAll($sql));

		include_once("./lib/paging/paging.php");

		$iCurrentPage = (isset($_GET['page'])&&$_GET['page']>0)?$_GET['page']:1;

		$iPerpage = 15;

		$sLimit = " LIMIT ".($iCurrentPage-1)*$iPerpage.",".$iPerpage; 

		$sUrlPath="?page={i}";

		$oPaging = new paging($iPerpage, $iTotalRecord, $iCurrentPage, $sUrlPath);

		$sPaging = $oPaging->getStringPaging();

		$product= $this->getAll($sql.$sOrder.$sLimit);	

		$this->assign("sPaging", $sPaging);





		$this->assign("product_item_list",$product);

		$this->display("product_search.tpl");

	

	}

}

?>