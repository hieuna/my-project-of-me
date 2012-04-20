<?php
require_once ( "about.class.php" );
class about
{
	function run()
	{
		$atask= $_GET["atask"];
		$task= $_GET["task"];
		switch ( $atask )
		{
			default:		
				$objAbout = new AboutBack();
				$objAbout -> run( $task );
				break;
		}			
	}	
}
?>