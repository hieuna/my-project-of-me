<?php

class infocart
{
	function run()
	{
		$atask= $_GET["atask"];
		$task= $_GET["task"];
		switch ( $atask )
		{
			case "photo":
				require_once ( "contact_photo.class.php" );
				$objPhoto= new contactPhoto();
				$objPhoto -> run( $task );
				break;
			default:	
				
				require_once ( "infocart.class.php" );	
				$objInfocart = new InfocartBack();
				$objInfocart -> run( $task );
				
				break;
		}			
	}	
}
?>