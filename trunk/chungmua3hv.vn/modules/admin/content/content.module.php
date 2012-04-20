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
				include("models/baseGroup.php");
				require_once ( "category.class.php" );
				$objMod = new CategoryBack();
				$objMod->run($task);
				break;	
			case "quangcao":
				require_once ( "quangcao.class.php" );
				$objMod = new quangcaoBack();
				$objMod->run($task);
				break;	
			case "image":
				require_once ( "image.class.php" );
				$objMod = new imageBack();
				$objMod->run($task);
				break;	
			case "link":
				require_once ( "link.class.php" );
				$objMod = new linkBack();
				$objMod->run($task);
				break;	
			case "notice":
				require_once ( "notice.class.php" );
				$objMod = new noticeBack();
				$objMod->run($task);
				break;	
			case "comment":
				require_once ( "comment.class.php" );
				$objMod = new commentBack();
				$objMod->run($task);
				break;
			case "email":
				require_once ( "email.class.php" );
				$objMod = new emailBack();
				$objMod->run($task);
				break;	
			case "video":
				require_once ( "video.class.php" );
				$objMod = new imageVideo();
				$objMod->run($task);
				break;	
			case "news":
				require_once ( "news.class.php" );
				$objMod = new newsBack();
				$objMod->run($task);
				break;	
			case "action":
				require_once ( "action.class.php" );
				$objMod = new actionBack();
				$objMod->run($task);
				break;	
			default:		
				require_once ( "news.class.php" );
				$oContent = new newsBack();
				$oContent -> run( $task );
				break;
		}			
	}	
}
?>