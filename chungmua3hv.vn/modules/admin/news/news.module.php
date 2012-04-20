<?php

class news
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
				require_once ( "news.class.php" );
				$oContent = new NewsBack();
				$oContent -> run( $task );
				break;
		}			
	}	
}
?>