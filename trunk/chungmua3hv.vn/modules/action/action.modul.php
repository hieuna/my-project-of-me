<?php
class action extends VS_Module_Base
{	
	function __construct(){
			@eval(getGlobalVars()); 
			parent::__construct($oDb,$oSmarty);
			$this->table="tblcontent";
			$this->type='action';
			$this->_prefix="Content_";
			$this->where=" where {$this->_prefix}LangID='".$_SESSION["lang_id"]."' ";
	}
	function run($task="")
	{	
		switch($task)
		{
			case "menu":
				$this->showMenu(); break;
			case "view":
				$this->viewAction(intval($_GET["id"])); break;
			case "home":
				$this->homeAction(); break;
			default: case "list":
				$this->listAction(); break;
		}
	
	}
	function getPageinfo($task){
		global $oSmarty;
		$aPageinfo['title'] = $oSmarty->get_config_vars("title_action");
		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_action");
		$aPageinfo['description'] = $oSmarty->get_config_vars("description_action");
		if($task=='view'){
			$title= $this->getOne("select  {$this->_prefix}Title from {$this->table} {$this->where} and {$this->_prefix}ID='".intval($_GET["id"])."'");
			$aPageinfo['title']="{$title} | ".$aPageinfo['title'];
		}
		return $aPageinfo;
	}
	function showMenu(){
		$menu=$this->getAll("select {$this->_prefix}ID,{$this->_prefix}Title 
		from tblaction 
		{$this->where} and {$this->_prefix}Status='1' order by {$this->_prefix}Order");
		$this->assign("action_menu",$menu);
		$this->display("action_menu.tpl");
	}
	function viewAction($id){
		$action= $this->getRow("select * from {$this->table} {$this->where} and {$this->_prefix}ID='{$id}'");
		$this->assign("action_item",$action);
		$other= $this->getAll("select  {$this->_prefix}ID, {$this->_prefix}Title,  {$this->_prefix}CreateDate 
		from {$this->table} {$this->where} and {$this->_prefix}ID <> '{$id}' and  {$this->_prefix}GroupID='{$action[' {$this->_prefix}GroupID']}' order by {$this->_prefix}Order,{$this->_prefix}ID limit 10");
		$this->assign("action_other",$other);
		$this->display("action_detail.tpl");
	
	}
	function homeAction(){
		$action= $this->getRow("select * from {$this->table} {$this->where} and {$this->_prefix}Populer='1' and {$this->_prefix}Status='1'  limit 1");
		$this->assign("action_item_home",$action);
		$this->display("action_home.tpl");
	
	}
	function listAction(){

		$sql="select * from {$this->table} {$this->where} and 
		{$this->_prefix}Status='1' and  {$this->_prefix}Type='{$this->type}' 
		order by {$this->_prefix}Order asc";
		
		$iTotalRecord = count($this->getAll($sql));
		include_once("./lib/paging/paging.php");
		$iCurrentPage = (isset($_GET['page'])&&$_GET['page']>0)?$_GET['page']:1;
		$iPerpage = 15;
		$sLimit = " LIMIT ".($iCurrentPage-1)*$iPerpage.",".$iPerpage; 
		$sUrlPath="?page={i}";
		$oPaging = new paging($iPerpage, $iTotalRecord, $iCurrentPage, $sUrlPath);
		$sPaging = $oPaging->getStringPaging();
		$action= $this->getAll($sql.$sOrder.$sLimit);	
		$this->assign("sPaging", $sPaging);


		$this->assign("action_item_list",$action);
		$this->display("action_list.tpl");
	
	}
}
?>