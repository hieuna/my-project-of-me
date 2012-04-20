<?php
class news extends VS_Module_Base
{	
	function __construct(){
			@eval(getGlobalVars()); 
			parent::__construct($oDb,$oSmarty);
			$this->table="tblcontent";
			$this->type='news';
			$this->_prefix="Content_";
			$this->where=" where {$this->_prefix}LangID='".$_SESSION["lang_id"]."' and  {$this->_prefix}Type='{$this->type}' ";
	}
	function run($task="")
	{	
		switch($task)
		{
			case "view":
				$this->viewItem(intval($_GET["ID"])); break;
			case "terms":
				$this->termCondination(); break;
			case "guide":
				$this->showGuide(); 
				break;
			case "introduction":
				$this->showIntro(); break;
			case "intro":
				$this->showallIntro(); break;
		}
	
	}
	function getPageinfo($task){
		global $oSmarty;
		$aPageinfo['title'] = $oSmarty->get_config_vars("title_home");
		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_home");
		$aPageinfo['description'] = $oSmarty->get_config_vars("description_home");
		if($task=='view'){
			$title= $this->getOne("select  {$this->_prefix}Title from {$this->table} where {$this->_prefix}ID='".intval($_GET["ID"])."'");
			$aPageinfo['title']="{$title} | ".$aPageinfo['title'];
		}
		if($_GET["gid"]){
			$title= $this->getOne("select  Group_Name from tblgroup where Group_ID='".intval($_GET["gid"])."'");
			$aPageinfo['title']="{$title} | ".$aPageinfo['title'];
		
		}
		return $aPageinfo;
	}
	function viewItem($id){
		$content = $this->getRow("select * from tblcontent where Content_ID='{$id}' and Content_Status='1'");
		$this->assign("content_item",$content);
		$this->display("form_show_content.tpl");
	}
	function termCondination(){
		global $oSmarty,$oDb;
		$sql = $oDb->getRow("select * from tblcontent where Content_Type ='terms'");
		$oSmarty->assign("terms",$sql);
		$oSmarty->display("viewTerms.tpl");
	
	}
	function showGuide(){
		global $oSmarty,$oDb;
		$sql = $oDb->getRow("select * from tblcontent where Content_Type ='guide'");
		$oSmarty->assign("terms",$sql);
		$oSmarty->display("viewGuide.tpl");
	}
	function showIntro()
	{
		global $oSmarty,$oDb;
		$id = $_GET['newid'];
		$sql = $oDb->getRow("select * from tblabout where About_Status='1' and About_ID = '{$id}'");
		$oSmarty->assign("terms",$sql);
		$oSmarty->display("details.tpl");	
	}
	function showallIntro()
	{
		global $oSmarty,$oDb;
		$sql = "select * from tblabout where About_Status='1'";
		$stringpage=SITE_URL;
		$stringpage.="introduction/Page-{i}/";	
		//echo $oDb->getOne($countsss);
		$iTotalRecord = count($oDb->getAll($sql));
		include_once("./lib/paging/paging.php");
		$iCurrentPage = (isset($_GET['page'])&&$_GET['page']>0)?$_GET['page']:1;
		$iPerpage = 1;
		//$number = $iTotalRecord/$iPerpage;
		//$pagenumber = floor($number)+1;
		//$fpage = ($iCurrentPage-1)*$iPerpage;
		///$lpages = $iCurrentPage*$iPerpage;
		$sLimit = " LIMIT ".($iCurrentPage-1)*$iPerpage.",".$iPerpage; 
		$sUrlPath=$stringpage;
		$oPaging = new paging($iPerpage, $iTotalRecord, $iCurrentPage, $sUrlPath);
		$sPaging = $oPaging->getStringPaging();
		//echo $sqldeals.$sLimit;
		$all=$oDb->getAll($sql.$sLimit);
		$oSmarty->assign("sPaging", $sPaging);
		//$oSmarty->assign('sql',$sql);
		$oSmarty->assign('intro',$all);
		$oSmarty->display('viewIntro.tpl');
	}
}
?>