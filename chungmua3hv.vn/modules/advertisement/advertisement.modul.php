<?php

class advertisement extends VS_Module_Base{	

function __construct(){
		@eval(getGlobalVars());
		parent::__construct($oDb,$oSmarty);
		$this->table = "tbl_image";	
		$this->imagePath ="upload/image/";	
	}
	function run($task)
	{	
		switch ($task)
			{				
				case "adv":
					$this->displayAdv();
					break;
			}
			
	}
	function displayAdv()
	{
		global $oSmarty,$oDb;
		$sql = $oDb->getAll("select * from tbl_image where Image_Status ='1' order by Image_Order limit 2");
		foreach($sql as $key=>$value)
		{
			$filesize= array("width" => 220,"height"=> 'auto');			
			$sql[$key]['str'] = $this -> showFlash(SITE_URL.$this->imagePath.$value['Image_Photo'],strtolower($value["Image_Type"]),$filesize);
		}
		$oSmarty -> assign("adver", $sql );	
		$oSmarty->display('adver.tpl');
	}
}
?>