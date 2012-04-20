<?php



class footer

{	

	function run($task="")

	{

		global $oDb, $oSmarty;		
		$sQuery = $oDb->getAll("select * from tblcontent where Content_Status='1' and Content_Type is null");
		$maxid = $oDb->getOne("select MAX(Content_ID) from tblcontent where Content_Status='1' and Content_Type is null");
		$oSmarty->assign('maxid',$maxid);
		$oSmarty->assign('footer',$sQuery);
		$oSmarty->display('footer.tpl');

	}

}

?>