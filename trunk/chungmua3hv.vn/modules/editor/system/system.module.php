<?php
class system {	

	function run()
	{
		$atask= $_GET["atask"];
		$task= $_GET["task"];	
		switch ($atask)
		{
			case 'system':
				include("system.class.php");
				$oObject= new SystemBack();
				switch( $task ){
					case 'add':
						$oObject -> addSystem();
						break;
					case 'edit':
						$oObject -> editSystem();
						break;
					case 'delete':
						$oObject -> deleteSystem();
						break;
					default:
						$oObject -> listSystem( $_GET['msg'] );
						break;
				}
				break;
				
			case 'roll':
				include("roll.class.php");				
				$oObject= new CRoll();
				switch($task){
					case 'add':
						$oObject -> addItem();
						break;
					case 'edit':
						$oObject -> editItem( );
						break;
					case 'delete':
						$oObject -> deleteItem( );
						break;
					case 'save_order':
						$oObject -> saveOrder();
						break;
					default:
						$oObject -> listItem( $_GET['msg']);
						break;
				}
				break;
			case 'language':
				require_once("language.class.php");				
				$oObject = new CLang();				
				switch( $task ){
					case 'add':
						$oObject -> addLang();
						break;
					case 'edit':
						$oObject -> editLang();
						break;
					case 'delete':
						$oObject -> deleteLang($_GET['id']);
						break;
					case 'set_default':
						$oObject -> setDefault( $_GET['id'] );
						break;
					default:						
						$oObject -> listLang();
						break;
				}
				break;
			
			case 'menu':
				include("menu.class.php");
				$oObject= new MenuBack();
				switch( $task ){
					case 'add':
						$oObject -> addItem();
						break;
					case 'edit':
						$oObject -> editItem();
						break;
					case 'delete':
						$oObject -> deleteItem();
						break;
					case 'delete_multile':
						$oObject -> deleteItems();
						break;
					case 'change_status':
						$oObject -> changeStatus($_GET['id'], $_GET['status']);
						break;
					case 'publish':						
						$oObject -> changeStatusMultiple( 1 );
						break;
					case 'unpublish':						
						$oObject -> changeStatusMultiple( 0 );
						break;
					case 'save_order':
						$oObject -> saveOrder();
						break;
					default:					
						$oObject -> listItem( $_GET['msg'] );		
						break;
				}
				
				break;

			case 'module':
			default :
				include("manage_module.class.php");
				$oObject= new CModule();
				switch( $task ){
					case 'add':
						$oObject -> addItem();
						break;
					case 'edit':
						$oObject -> editItem();
						break;
					case 'delete':
						$oObject -> deleteItem();
						break;
					case 'delete_multile':
						$oObject -> deleteItems();
						break;
					case 'change_status':
						$oObject -> changeStatus($_GET['id'], $_GET['status']);
						break;
					case 'publish':						
						$oObject -> changeStatusMultiple( 1 );
						break;
					case 'unpublish':						
						$oObject -> changeStatusMultiple( 0 );
						break;
					case 'save_order':
						$oObject -> saveOrder();
						break;
					default:					
						$oObject -> listItem( $_GET['msg'] );		
						break;
				}							
		}
	}
		
}

?>