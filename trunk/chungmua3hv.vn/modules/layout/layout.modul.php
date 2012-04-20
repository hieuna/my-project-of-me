<?php
class layout
{	
	function run($task= "")
	{

	
		global $oSmarty;
		$modul= ($_GET["mod"]!="")?$_GET["mod"]:"home";
		if($modul=='home'){
			if($_SESSION["ppcity"]){
				header("Location:".SITE_URL.$_SESSION["ppcity"]."/");
			}
		}
		if( is_file("themes/{$_SESSION['theme']}/templates/layout/{$modul}.tpl")){		
			$aPageinfo = $this->getPageinfo($modul, $task);							
			$oSmarty->assign("aPageinfo",$aPageinfo);			
			
			$oSmarty->display("{$modul}.tpl");

		}else{
			//echo 'template not found !';
			$aPageinfo = $this->getPageinfo($modul, $task);							
			$oSmarty->assign("aPageinfo",$aPageinfo);			
			$oSmarty->display("default.tpl");
		}
	}
	
	function getPageinfo($modul='home', $task="")
	{		
		if(file_exists("modules/$modul/$modul.modul.php")) {
			$model= "base". ucfirst($modul);
			if(file_exists("models/{$model}.php")) {
				include_once("models/{$model}.php");
			}
			
			include_once("modules/$modul/$modul.modul.php");
			$mod = new $modul();						
			$aPageinfo = $mod->getPageinfo($task);
		}
		
		return $aPageinfo;
	}

}
?>