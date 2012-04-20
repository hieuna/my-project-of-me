<?php
class search extends VS_Module_Base
{	
	function __construct(){
			@eval(getGlobalVars()); 
			parent::__construct($oDb,$oSmarty);
			$this->table="tblproduct";
			//$this->type='news';
			$this->_prefix="Product_";
			$this->where=" where {$this->_prefix}LangID='".$_SESSION["lang_id"]."' ";
	}
	function run($task="")
	{	
		switch($task)
		{
			case "form":
				$this->formSearch(); break;
			case "home":
				$this->homeSearch(); break;
			case "deals":
				$this->dealsSearch(); break;
			default: 
				$this->listSearch(); break;
		}
	
	}
	function getPageinfo(){
		global $oSmarty;
		$aPageinfo['title'] = $oSmarty->get_config_vars("title_search");
		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_home");
		$aPageinfo['description'] = $oSmarty->get_config_vars("description_home");
		return $aPageinfo;
	}
	function dealsSearch(){
		global $oDb,$oSmarty;
		$name = isset($_POST["name"])?$_POST["name"]: "";	
		$sites = isset($_POST["sites"])?$_POST["sites"]: "";	
		$category = isset($_POST["category"])?$_POST["category"]: "";
		//echo $category;
		$startdate = isset($_POST["startdate"])?$_POST["startdate"]: "";
		$enddate = isset($_POST["enddate"])?$_POST["enddate"]: "";
		$sortBy = isset($_POST["sortBy"])?$_POST["sortBy"]: "";
		if(($name!="") or ($sites!="") or ($category!="") or ($startdate!="") or ($enddate!=""))
		{
			$sql= "select * from tblproduct where Product_Status='1' and Product_LangID =".$_SESSION['lang_id']."";
			if($name)
				$sql.=" and Product_Name like '%{$name}%'";
			if($sites)
				$sql.=" and (Product_DestinationID = '{$sites}' or Product_DestinationID in (select Group_ID from tblgroup where Group_ParentID='{$sites}') or Product_DestinationID in (select Group_ParentID from tblgroup where Group_ID='{$sites}'))";
			if($category)
				$sql.=" and (Product_GroupID = '{$category}' or Product_GroupID in (select Group_ID from tblgroup where Group_ParentID='{$category}'))";
			if($startdate)
				$sql.=" and Product_StartDate <= '$startdate'";
			if($enddate)
				$sql.=" and Product_EndDate >= '$enddate'";
			if($sortBy)
				{
					if($sortBy == 'latest')
						$sql.=" order by Product_EndDate DESC";
					if($sortBy == 'az')
						$sql.=" order by Product_Name";
					if($sortBy == 'za')
						$sql.=" order by Product_Name DESC";
					if($sortBy == 'lh')
						$sql.=" order by Product_DealPrice ASC";
					if($sortBy == 'hl')
						$sql.=" order by Product_DealPrice DESC";
				}				
			$iTotalRecord = count($oDb->getAll($sql));
			include_once("./lib/paging/pagingajax.php");
			$iCurrentPage = (isset($_GET['page'])&&$_GET['page']>0)?$_GET['page']:1;
			$iPerpage = 10;
			$sLimit = " LIMIT ".($iCurrentPage-1)*$iPerpage.",".$iPerpage; 
			$sUrlPath= "get_deals_ajax({i})";	
			$oPaging = new paging($iPerpage, $iTotalRecord, $iCurrentPage, $sUrlPath);
			$sPaging = $oPaging->getStringPaging();		
			//echo $sqldeals.$sLimit;
			$deals=$oDb->getAll($sql.$sLimit);
			foreach($deals as $key=>$value)
			{
					if(($value['Product_Price']=='0') or ($value['Product_Price'] == $value['Product_DealPrice']))
					{
						$deals[$key]["save"] = '0';
					}
					else
					{
						$deals[$key]["save"] = round(($value['Product_Price']-$value['Product_DealPrice'])/$value['Product_Price']*100);
					}
					$deals[$key]["match"] = round(($value['Product_Buy']/$value['Product_Quantity'])*10);
					//echo 	round(($value['Deals_OldPrice']-$value['Deals_Price'])/$value['Deals_OldPrice']*100)."<br/>";
			}
			$oSmarty->assign("deals",$deals);
			$oSmarty->assign("sPaging", $sPaging);
		}
		$oSmarty->display('ajaxSearch.tpl');
	}
	function listSearch(){
		global $oSmarty,$oDb;
		$this->setParent(&$arrPanrent,0,0,'','destination');
		$this->setParent(&$type,0,0,'','deal');
		$oSmarty->assign("arrPanrent",$arrPanrent);
		$oSmarty->assign("arrtype",$type);
		$oSmarty->display('home_search.tpl');
	}
	function setParent(&$arrPanrent,$id,$idp=0,$text='',$type='',$lang='', $partten = " --- ")
	{		
		global $oDb;
		$prefix='Group_';
		$stbl = 'tblgroup';
		// type of category
		if ($type == '') $type = $_GET['amod'];
		// default sql where
		$sWhere = "{$prefix}ParentID={$idp} and {$prefix}Type='{$type}'";
		// if use language
		//if has id of current item, get other item
		if($lang!=""){
			$sWhere.= " and {$prefix}LangID ='".$lang."'";
		}
		elseif($_SESSION["lang_id"]){
			$sWhere.= " and {$prefix}LangID ='".$_SESSION["lang_id"]."'";
		}
		if($id){
			$sWhere.= " and {$prefix}ID<>{$id}";
		}
		
		$sql="select {$prefix}ID,".$prefix."Name from {$stbl} where {$sWhere}";	
		$rows=$oDb->getAll($sql);	
			
		if(count($rows)){
		  	foreach($rows as $row)
		    {
				 $arrPanrent[$row["{$prefix}ID"]] =$text. $row["{$prefix}Name"];
				 $this->setParent($arrPanrent,$id,$row["{$prefix}ID"],$text.$partten,$type,$lang);
			}
		}
	}
	
	
	
}
?>