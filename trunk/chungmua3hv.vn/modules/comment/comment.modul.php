<?php
class comment extends VS_Module_Base
{	
	function __construct(){
			@eval(getGlobalVars()); 
			parent::__construct($oDb,$oSmarty);
			$this->table="tblcomment";
			$this->type='product';
			$this->_prefix="Comment_";
			$timemow= mktime();
			$this->where=" where {$this->_prefix}Status='1'";
			
	}
	function run($task="")
	{	
		switch($task)
		{
			case "report":
				$this->showReport(); break;
			case "menu":
				$this->showMenu(); break;
			case "category":
				$this->showGetCategory($_GET["DID"]); break;
			case "new":
				$this->showNew(); break;
			case "like":
				$this->showLike(); break;
			case "load":
				$this->loadItem(); break;
			case "promotion":
				$this->showPromotion(); break;
			case "view":
				$this->viewItem(intval($_GET["ID"])); break;
			case "home":
				$this->homeItem(); break;
			case "search":
				$this->listSearch(); break;
			default: case "list": 
				$this->listItem($_GET["CID"]); break;
		}
	
	}
	function getPageinfo($task){
		global $oSmarty;
		$aPageinfo['title'] = $oSmarty->get_config_vars("title_product");
		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_product");
		$aPageinfo['description'] = $oSmarty->get_config_vars("description_product");
		if($task=='view'){
			$title= $this->getOne("select  {$this->_prefix}Name from {$this->table} {$this->where} and {$this->_prefix}ID='".intval($_GET["id"])."'");
			$aPageinfo['title']="{$title} | ".$aPageinfo['title'];
		}
		return $aPageinfo;
	}
	function showReport(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$this->query("update tblcomment set Comment_Report= Comment_Report+1 where Comment_ID='".$_POST["id"]."'");
			$this->display("comment_form_report_okie.tpl");
		}else{
		$this->assign("comment",$this->getRow("select * from tblcomment where Comment_ID='".intval($_GET["ID"])."'"));
		$this->display("comment_form_report.tpl");
		}
	}
	function showLike()
	{
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$this->query("update tblcomment set Comment_Like= Comment_Like+1 where Comment_ID='".$_POST["id"]."'");
			$this->display("comment_form_like_okie.tpl");
		}else{
		$this->assign("comment",$this->getRow("select * from tblcomment where Comment_ID='".intval($_GET["ID"])."'"));
		$this->display("comment_form_like.tpl");
		}
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
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_comment = $_POST["frmComment"];
			$this->query("insert into tblcomment (Comment_Content,Comment_ProductID,Comment_MemberID,Comment_Status,Comment_Report,Comment_MemberReplyID,Comment_Mktime) values ('{$_comment}','".trim($_POST["frmPID"])."','".$_SESSION["user"]["ID"]."','1','0',0,'".mktime()."')");
			
		header("Location:".SITE_URL."thong-bao.html?url=". encode(selfUrl()."?goto=true")."&msg=". encode("Bạn đã gửi bình luận thành công. Chúng tôi sẽ kiểm tra trước khi kích hoạt bình luận của bạn. Xin cảm ơn."));
		}
		$product= $this->getAll("select *,(select Member_Name from tblmember where Member_ID = {$this->_prefix}MemberID) as Member_Name from {$this->table} {$this->where} and {$this->_prefix}ProductID='{$id}' and {$this->_prefix}MemberReplyID='0' order by {$this->_prefix}ID desc limit 2 ");
		if($product)
			foreach($product as $key => $value){
				$product[$key]["reply"] = $this->getAll("select * from tblcomment where Comment_MemberReplyID='".$value["Comment_ID"]."' and Comment_ProductID='".$id."'");
			}
		$this->assign("comment_item",$product);
		$this->display("comment_detail.tpl");
	
	}
	function loadItem(){
	 	$from= intval($_GET["ID"]);
		 $pid= intval(trim($_GET["PID"]));
		$product= $this->getAll("select *,(select Member_Name from tblmember where Member_ID = {$this->_prefix}MemberID) as Member_Name from {$this->table} {$this->where} and {$this->_prefix}ProductID='{$pid}' and {$this->_prefix}MemberReplyID='0' and {$this->_prefix}ID < '{$from}'  order by {$this->_prefix}ID desc limit 2");
		//echo 
	//	print_r($product);
		if($product)
			foreach($product as $key => $value){
				$product[$key]["reply"] = $this->getAll("select * from tblcomment where Comment_MemberReplyID='".$value["Comment_ID"]."' and Comment_ProductID='{$pid}'");
			$this->assign("comment_item_ajax",$product);
			$this->display("comment_show_ajax.tpl");
			}
		//print_r($product);
	
	}
	function homeItem(){
		$product= $this->getAll("select *,(select Group_Name from tblgroup where Group_ID= {$this->_prefix}DestinationID) as DestinationID from tblproduct {$this->where} order by {$this->_prefix}ID desc limit 5");
		
		$this->assign("product_item_home",$product);
		$this->display("product_home.tpl");
	
	}
	function showNew(){
		$product= $this->getAll("select * from {$this->table} {$this->where} and  {$this->_prefix}Status='1' and {$this->_prefix}New='1' order by   {$this->_prefix}ID desc");
		$this->assign("product_item_new",$product);
		$this->display("product_home_new.tpl");
	}
	function showPromotion(){
		$product= $this->getAll("select * from {$this->table} {$this->where} and  {$this->_prefix}Status='1' and {$this->_prefix}Promotion='1' order by   {$this->_prefix}ID desc");
		$this->assign("product_item_promotion",$product);
		$this->display("product_home_promotion.tpl");
	}
	
	function listItem($gid='0'){
		
		if($gid){
			$category = $this->getRow("select * from tblgroup where Group_Mark='{$gid}'");
		}
		
	 	$sql="select *,(select Group_Name from tblgroup where Group_ID= {$this->_prefix}DestinationID) as DestinationID from {$this->table}  {$this->where} and {$this->_prefix}DestinationID= '".$category["Group_ID"]."'";
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