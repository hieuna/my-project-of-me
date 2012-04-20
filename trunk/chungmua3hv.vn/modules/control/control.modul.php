<?php
class control extends VS_Module_Base
{	
	function __construct(){
			@eval(getGlobalVars()); 
			parent::__construct($oDb,$oSmarty);
			$this->table = "tbl_image";	
			$this->imagePath ="upload/image/";	
	}
	function run($task="")
	{	
		switch($task)
		{
			case "css":
				$this->css(); break;
			case "right":
				$this->showRight(); break;
			case "learn":
				$this->showMore(); break;
			case "rightac":
				$this->showRightAc(); break;
		}
	
	}
	function css(){
	$this->display("cssDisplay.tpl");
	}
	function showRight()
	{
		global $oSmarty,$oDb;	
		$this->display("rightDisplay.tpl");
	}
	function showMore()
	{
		$this->display("displayMore.tpl");
	}
	function showRightAc()
	{
		global $oSmarty,$oDb;	
		$sql = $oDb->getAll("select * from tbl_image where Image_Status ='1' order by Image_Order limit 1");
		foreach($sql as $key=>$value)
		{
			$filesize= array("width" => 220,"height"=> 308);			
			$sql[$key]['str'] = $this -> showFlash(SITE_URL.$this->imagePath.$value['Image_Photo'],strtolower($value["Image_Type"]),$filesize);
		}
		$oSmarty -> assign("adver", $sql );	
		$oSmarty->display("rightAcDisplay.tpl");
	}
}
?>