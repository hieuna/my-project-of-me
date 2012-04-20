<?php



class product

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

			case "destination":

				include("models/baseGroup.php");

				require_once ( "destination.class.php" );

				$objMod = new DestinationBack();

				$objMod->run($task);

				break;	

			case "hotelcategory":

				include("models/baseGroup.php");

				require_once ( "hotelcategory.class.php" );

				$objMod = new HotelcategoryBack();

				$objMod->run($task);

				break;	

			case "hotel":

				require_once ( "hotel.class.php" );

				$oContent = new HotelBack();

				$oContent -> run( $task );

				break;

			case "city":

				include("models/baseGroup.php");

				require_once ( "city.class.php" );

				$oContent = new cityBack();

				$oContent -> run( $task );

				break;

			case "guide":

				include("models/baseGuide.php");

				require_once ( "guide.class.php" );

				$oContent = new GuideBack();

				$oContent -> run( $task );

				break;

			case "option":

				require_once ( "extend.class.php" );

				$oContent = new CExtend();

				$oContent -> run( $task );

				break;

			case "dayle":

				require_once ( "dayle.class.php" );

				$oContent = new dayleBack();

				$oContent -> run( $task );

				break;

			case "optionhotel":

				require_once ( "optionhotel.class.php" );

				$oContent = new OptionHotel();

				$oContent -> run( $task );

				break;

			default:		

				require_once ( "product.class.php" );

				$oContent = new ProductBack();

				$oContent -> run( $task );

				break;

		}			

	}	

}

?>