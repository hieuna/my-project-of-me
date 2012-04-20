<?php
checkError(0);
class support
{
	function run()
	{
		$task = $_GET['task'];
		$atask = $_GET['atask'];		
		require_once( "support.class.php" );
		$objMod = new supportBack();		
		$objMod -> run( $task );
			
		
	}
}
?>