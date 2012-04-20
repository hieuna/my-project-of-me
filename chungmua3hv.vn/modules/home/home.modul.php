<?php
class home extends VS_Module_Base
{
	function __construct(){
			@eval(getGlobalVars()); 
			parent::__construct($oDb,$oSmarty);
	}
	
	function run($task="")
	{	
		switch($task)
		{
			default:
				$this->ShowHomePage();		
				break;
		}
	
	}
	
	function  getPageInfo($sTask){
		global $oSmarty;
		$aPageinfo['title'] = $oSmarty->get_config_vars("title_home");
		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_home");
		$aPageinfo['description'] = $oSmarty->get_config_vars("description_home");
		$aPath[] = array('title'=>$oSmarty->get_config_vars('HOME'),'link'=>SITE_URL);		
		$oSmarty->assign('aPath',$aPath);
		return $aPageinfo;
	}	
	function ShowHomePage()
	{
		global $oSmarty;
		$oSmarty->display("vhome.tpl");	
	}
}
?>