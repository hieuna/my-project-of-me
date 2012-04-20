<?php

class poll
{
	function run()
	{
		$task = $_GET['task'];
		$atask = $_GET['atask'];
		switch ( $atask )
		{
			default:
				require_once( "poll.class.php" );
				$objMod = new pollBack();		
				$objMod -> run( $task );
				break;
			case 'vote':
				require_once( "vote.class.php" );
				$objMod = new voteBack();
				$objMod -> run( $task );
				break;
			
		}
		
	}
}
?>