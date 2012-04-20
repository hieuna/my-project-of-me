<?php
//require_once('models/baseBusiness.php');
class deals extends VS_Module_Base   
{
	
	function __construct(){
			@eval(getGlobalVars()); 
			parent::__construct($oDb,$oSmarty);
		
		//$oSmarty->assign('currency', getConfig('currency'));
		//$oSmarty->assign('rate', getConfig('rate_currency'));
		//$this->limit_product_hot=getConfig('limit_product_hot');
	}
	
	function run($task)
	{
			switch ($task)
			{				
				case "right":
					$this->rightDeals();
					break;
				case "typical":
					$this->typicalDeals();
					break;
				case "list":
					$this->listDeals();
					break;
				case "old":
					$this->listDeals();
					break;
				case "ajaxsolddeals":
					$this->ajaxsold();
					break;
				case "detail":
					$this->dealsDetail($_GET['ID']);
					break;				
			}
	 }
	 
	 function  getPageinfo($sTask)
	 {
		global $oSmarty;
		$aPageinfo['title'] = $oSmarty->get_config_vars("title_home");
		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_product");
		$aPageinfo['description'] = $oSmarty->get_config_vars("description_product");
			switch ($sTask)
			{								
				case "detail":
					$deals= $this->getRow("select Product_ID as id,Product_Name as name,Product_Content as content from tblproduct where Product_ID ='".$_GET["ID"]."'");
						$aPageinfo['title'] = $deals["name"]. " - Deals - LocalDeal.vn";
						$aPageinfo['keyword'] = $deals["name"]." - Deals";
						$aPageinfo['description'] = $deals["name"];
						//print_r($deals);
					break;
				
			}
		return $aPageinfo;
	}
	function rightDeals()
	{
		global $oSmarty,$oDb;
		$day = mktime();
		$sql = $oDb->getAll("select * from tblproduct where Product_Status ='1' and Product_Discounts ='1' and Product_StartDate <= '{$day}' and Product_EndDate >= '{$day}' and Product_LangID = '{$_SESSION['lang_id']}' order by Product_EndDate DESC limit 3");
		foreach($sql as $key=>$value)
			{
				if(($value['Product_Price']=='0') or ($value['Product_Price'] == $value['Product_DealPrice']))
				{
					$sql[$key]["save"] = '0';
				}
				else
				{
					$sql[$key]["save"] = round(($value['Product_Price']-$value['Product_DealPrice'])/$value['Product_Price']*100);
				}
				//$sql[$key]["match"] = round(($value['Product_Buy']/$value['Product_Quantity'])*10);
				//echo 	round(($value['Deals_OldPrice']-$value['Deals_Price'])/$value['Deals_OldPrice']*100)."<br/>";
			}
		$oSmarty -> assign("deals", $sql );	
		$oSmarty->display("rightDeals.tpl");	
	}
	function typicalDeals()
	{
		global $oSmarty,$oDb;
		$day =mktime();
		$tmp = "select * from tblproduct where Product_Status ='1' ";
		$tmp.= " and Product_StartDate <= '{$day}' and Product_EndDate >= '{$day}' and Product_LangID = '{$_SESSION['lang_id']}' order by Product_EndDate DESC limit 3"; 
		$sql = $oDb->getAll($tmp);
		foreach($sql as $key=>$value)
			{
				if(($value['Product_Price']=='0') or ($value['Product_Price'] == $value['Product_DealPrice']))
				{
					$sql[$key]["save"] = '0';
				}
				else
				{
					$sql[$key]["save"] = round(($value['Product_Price']-$value['Product_DealPrice'])/$value['Product_Price']*100);
				}
				$sql[$key]["match"] = round(($value['Product_Buy']/$value['Product_Quantity'])*10);
				//echo 	round(($value['Deals_OldPrice']-$value['Deals_Price'])/$value['Deals_OldPrice']*100)."<br/>";
			}
		//print_r($sql);
		$dnotes = $this->getRow("select * from tblcontent where Content_Type='notes' and Content_LangID = '{$_SESSION['lang_id']}'"); 
		//print_r($dnotes);
		$oSmarty -> assign("dnotes", $dnotes );	
		$oSmarty -> assign("typicaldeals", $sql );	
		$oSmarty->display("typicalDeals.tpl");	
	}
	function dealsDetail($id)
	{
		global $oSmarty,$oDb;
		$sql = $oDb->getRow("select * from tblproduct where Product_Status ='1' and Product_ID= '{$id}'");

				$sql["save"] = round(($sql['Product_Price']-$sql['Product_DealPrice'])/$sql['Product_Price']*100);
				$sql["match"] = round(($sql['Product_Buy']/$sql['Product_Quantity'])*10);
				//echo 	round(($value['Deals_OldPrice']-$value['Deals_Price'])/$value['Deals_OldPrice']*100)."<br/>";

			//print_r($sql);
		$dnotes = $this->getRow("select * from tblcontent where Content_Type='notes' and Content_LangID = '{$_SESSION['lang_id']}'"); 
		//print_r($dnotes);
		$oSmarty -> assign("dnotes", $dnotes );	
		$oSmarty -> assign("deals", $sql );	
		$oSmarty->display("viewDeals.tpl");	
	}
	function listDeals()
	{
		global $oSmarty,$oDb;
		$day =mktime();
		$grm = $_SESSION['pid'];
		$sql = 	$oDb->getAll("select * from tblproduct where Product_Status='1' and Product_LangID = '{$_SESSION['lang_id']}' and Product_StartDate <= '{$day}' and Product_EndDate >= '{$day}' and (Product_DestinationID = '$grm' or Product_DestinationID in (select Group_ID from tblgroup where Group_ParentID='{$grm}')) limit 3");
		//print_r($sql);
		foreach($sql as $key=>$value)
			{
				if(($value['Product_Price']=='0') or ($value['Product_Price'] == $value['Product_DealPrice']))
				{
					$sql[$key]["save"] = '0';
				}
				else
				{
					$sql[$key]["save"] = round(($value['Product_Price']-$value['Product_DealPrice'])/$value['Product_Price']*100);
				}
				$sql[$key]["match"] = round(($value['Product_Buy']/$value['Product_Quantity'])*10);
				//echo 	round(($value['Deals_OldPrice']-$value['Deals_Price'])/$value['Deals_OldPrice']*100)."<br/>";
			}
		$dnotes = $this->getRow("select * from tblcontent where Content_Type='notes' and Content_LangID = '{$_SESSION['lang_id']}'"); 
		$oSmarty -> assign("dnotes", $dnotes );	
		$oSmarty -> assign("deals", $sql );	
		if($_GET['task'] == 'old')
		{$oSmarty->display('viewSoldDeal.tpl');	}
		else
		{
			$oSmarty->display('cityDeals.tpl');
		}
	}
	/*function soldDeals()
	{
		global $oSmarty,$oDb;		
		$oSmarty->display('viewSoldDeal.tpl');	
	}*/
	function ajaxsold()
	{
		global $oSmarty,$oDb;
		$day = mktime();
		$sql = "select * from tblproduct where Product_Status='1' and Product_LangID = '{$_SESSION['lang_id']}'  and Product_EndDate < '{$day}' ";
		if(isset($_SESSION['pid']))
		{
			$c = $_SESSION['pid'];
			$sql.= " and (Product_DestinationID = '$c' or Product_DestinationID in (select Group_ID from tblgroup where Group_ParentID='{$c}'))";
		}
		$sql.= " order by Product_EndDate DESC";
		//echo $sql;
		$iTotalRecord = count($oDb->getAll($sql));
		include_once("./lib/paging/pagingajax.php");
		$iCurrentPage = (isset($_GET['page'])&&$_GET['page']>0)?$_GET['page']:1;
		$iPerpage = 10;
		$sLimit = " LIMIT ".($iCurrentPage-1)*$iPerpage.",".$iPerpage; 
		$sUrlPath= "get_deals_ajax({i})";	
		$oPaging = new paging($iPerpage, $iTotalRecord, $iCurrentPage, $sUrlPath);
		$sPaging = $oPaging->getStringPaging();		
		//echo $sqldeals.$sLimit;
		$solddeals=$oDb->getAll($sql.$sLimit);
		foreach($solddeals as $key=>$value)
		{
				if(($value['Product_Price']=='0') or ($value['Product_Price'] == $value['Product_DealPrice']))
				{
					$solddeals[$key]["save"] = '0';
				}
				else
				{
					$solddeals[$key]["save"] = round(($value['Product_Price']-$value['Product_DealPrice'])/$value['Product_Price']*100);
				}
				$solddeals[$key]["match"] = round(($value['Product_Buy']/$value['Product_Quantity'])*10);
				//echo 	round(($value['Deals_OldPrice']-$value['Deals_Price'])/$value['Deals_OldPrice']*100)."<br/>";
		}
		$oSmarty->assign("sPaging", $sPaging);
		$oSmarty->assign("deals",$solddeals);
		//print_r($alldeals);
		$oSmarty->display('ajaxSoldDeals.tpl');	
	}
}
?>