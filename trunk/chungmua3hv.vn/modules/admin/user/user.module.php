<?php
class user {	

	function run()
	{
		
		
		$atask= $_GET["atask"];
		$task= $_GET["task"];
		
		switch ($atask)
		{	
			case 'group':
				include("manage_user_type.class.php");
				$manage_user= new UserTypeBack();
				$manage_user->run($task);
				 break;
			case "user" :
				include("manage_user.class.php");
				$manage_user= new manage_user();
				switch ($task)
				{			
					case "edit":
						$manage_user->editUser();
						break;
					case "delete":
						$manage_user->deleteUser();
						break;
					case "multi_delete":
						$manage_user->deleteMultiUser();
						break;					
					case "add":
						$manage_user->addUser();
						break;
					default: case "list" :
						$manage_user->listUser( $_GET['msg'] );
						 break;
				}				
				 break;
			
				
		}
	}
		
}

?>