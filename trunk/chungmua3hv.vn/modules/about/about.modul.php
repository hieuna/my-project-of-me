<?php
class about extends VS_Module_Base
{	
	function __construct(){
			@eval(getGlobalVars()); 
			parent::__construct($oDb,$oSmarty);
			$this->table="tblabout";
			$this->_prefix="About_";
			$this->where=" where {$this->_prefix}LangID='".$_SESSION["lang_id"]."' ";
	}
	function run($task="")
	{	
		switch($task)
		{
			case "menu":
				$this->showMenu(); break;
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
	
	function showMenu(){
		$menu=$this->getAll("select {$this->_prefix}ID,{$this->_prefix}Title 
		from tblabout 
		{$this->where} and  {$this->_prefix}Status='1' order by {$this->_prefix}Order");
		$this->assign("about_menu",$menu);
		$this->display("about_menu.tpl");
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
}
?>