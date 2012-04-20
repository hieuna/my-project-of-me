<?php

class support extends VS_Module_Base{	

function __construct(){
		@eval(getGlobalVars());
		parent::__construct($oDb,$oSmarty);
		$this->table = "tblsupport";	
	}
	function run($task)
	{	
		global $oDb,$oSmarty;
		$sql = $oDb->getAll("select * from tblsupport where Support_Status='1'");
		$oSmarty -> assign("support", $sql );	
		$oSmarty->display('displaySupport.tpl');
	}
}
?>