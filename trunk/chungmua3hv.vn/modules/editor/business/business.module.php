<?php

class business
{
	function run()
	{
		$atask= $_GET["atask"];
		$task= $_GET["task"];
		switch ( $atask )
		{
			case "groupLocation":
				include("models/baseGroup.php");
				require_once ( "location.class.php" );
				$objMod = new localtion();
				$objMod->run($task);
				break;
			case "groupTruelocal":
				include("models/baseGroup.php");
				require_once ( "category.class.php" );
				$objMod = new category();
				$objMod->run($task);
				break;
			case "zone":
				require_once ( "zone.class.php" );
				$objMod = new ZoneBack();
				$objMod->run($task);
				break;	
			case "deals":
				require_once ( "deals.class.php" );
				$objMod = new DealsBack();
				$objMod->run($task);
				break;	
			default:		
				require_once ( "business.class.php" );
				$oContent = new BusinessBack();
				$oContent -> run( $task );
				break;
		}			
	}	
}
?>