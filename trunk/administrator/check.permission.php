<?php
if ($admin_group!=1){
	$objAcl = new PGAcl();
	$permisstion = $objAcl->checkPermission($page, $task);
	
	foreach ($permisstion as $key => $value) {
		$arrAccess[] = $objAcl->atl[$value];
	}
	if (!in_array($task, $arrAccess)){
		if($objAcl->atl[$value] != $task){
			echo '<script language="javascript" type="text/javascript">
					document.location.href="admin.errors.php";
				</script>';
			exit();
		}
	}
}
?>