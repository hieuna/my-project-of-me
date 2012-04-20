<?php

class contact
{
	function run()
	{
		$atask= $_GET["atask"];
		$task= $_GET["task"];
		switch ( $atask )
		{
			default:		
				require_once ( "contact.class.php" );
				$oContent = new ContactBack();
				$oContent -> run( $task );
				break;
			case "tocontact":		
				require_once ( "tocontact.class.php" );
				$oContent = new ContactBack();
				$oContent -> run( $task );
				break;
		}			
	}	
}
?>