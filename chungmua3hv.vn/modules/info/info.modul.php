<?php

class info extends VS_Module_Base

{	

	function __construct(){

			@eval(getGlobalVars()); 

			parent::__construct($oDb,$oSmarty);

			$this->table="tblcontent";

			//$this->type='news';

			$this->_prefix="Content_";

			//$this->where=" where {$this->_prefix}LangID='".$_SESSION["lang_id"]."' and  {$this->_prefix}Type='{$this->type}' ";

	}

	function run($task="")

	{	
		switch($task)

		{

			case "view":

				$this->viewItem($_GET["ID"]); break;
		}

	

	}

	function getPageinfo($task){

		global $oSmarty;

		$aPageinfo['title'] = $oSmarty->get_config_vars("title_home");

		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_home");

		$aPageinfo['description'] = $oSmarty->get_config_vars("description_home");

		if($task=='view'){

			$title= $this->getOne("select  {$this->_prefix}Title from {$this->table} where {$this->_prefix}Marks='".$_GET["ID"]."'");

			$aPageinfo['title']="{$title} | ".$aPageinfo['title'];

		}
		return $aPageinfo;

	}

	function viewItem($id){

		$content = $this->getRow("select * from tblcontent where Content_Marks='{$id}' and Content_Status='1'");

		$this->assign("content_item",$content);

		$this->display("form_show_content.tpl");

	}
}

?>