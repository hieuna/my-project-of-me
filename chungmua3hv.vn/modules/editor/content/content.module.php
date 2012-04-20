<?php

class content
{
	function run()
	{
		$atask= $_GET["atask"];
		$task= $_GET["task"];
		switch ( $atask )
		{
			case "category":
				require_once ( "category.class.php" );
				$objMod = new CategoryBack();
				$objMod->run($task);
				break;	
			case "zone":
				require_once ( "zone.class.php" );
				$objMod = new ZoneBack();
				$objMod->run($task);
				break;	
			default:		
				require_once ( "content.class.php" );
				$oContent = new ContentBack();
				$oContent -> run( $task );
				break;
		}			
	}	
}
?>