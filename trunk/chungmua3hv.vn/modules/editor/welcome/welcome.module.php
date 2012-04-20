<?php
class welcome {	

	function run($atask="")
	{
		global  $oSmarty;
		//echo "<div align=\"center\" style=\"padding-top:50px;\"><h3>Welcome to administrator panel</h3></div>";
		$oSmarty -> display("welcome.tpl");
		
	}
}

?>