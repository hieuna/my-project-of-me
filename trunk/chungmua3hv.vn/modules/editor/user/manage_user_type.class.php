
<script language="javascript">
	function open_win(id)
	{	
		win = window.open("?amod=user&atask=group&task=popup&id="+id+"&ajax", "sendtofriend", "location=1,status=1,scrollbars=1,width=700,height=800");
		
	}

</script>

<?php

class UserTypeBack extends VS_Module_Base{
	function __construct(){
		@eval(getGlobalVars());
		parent::__construct( $oDb );
		$this -> vsDb -> setTable('user_type');
	}	
	
	function run( $task )
	{
		switch ( $task )
		{
			default:
				$this -> listUserType();
				break;
			case "add":
				$this -> addUserType();
				break;
			case "edit":
				$this -> editUserType();
				break;
			case "delete":
				$this -> deleteUserType();
				break;
			case "multi_delete":
				$this -> deleteMultiUserType();
				break;
			case "popup":
				$this -> addModule( $_GET['id'] );
				break;
		}
	}
		
	function addUserType()
	{
		$this->getPath("User module >> Manage User Type >> Add User Type");
		$this -> buildForm();
	}
	
	function editUserType()
	{
		$id = $_GET['id'];
		$this->getPath("User module >> Manage User Type >> Edit User Type with id: {$id}");		
		
		$row = $this -> vsDb -> getRow( $id );
		$this -> buildForm( $row );
	}

	function deleteUserType()
	{
		global $oDb;
		$id = $_GET["id"];		
		$sql = "delete from tbl_usertype_moduleroll where user_type_id ='{$id}'";
		$res = $oDb -> query( $sql );		
		$this -> vsDb -> deleteWithPk( $id );
		$_SESSION['msg'] = "Item has been deleted at ". date('Y-m-d h:i:s');
		$this -> redirect($_COOKIE['re_dir']);
	}
	
	function deleteMultiUserType()
	{
		$aItems	 = $_GET['arr_check'];
		if(is_array( $aItems) && count( $aItems) > 0){
			$sItems = implode( ',', $aItems );
			$this -> vsDb -> deleteWithPk( $sItems );
		}
		$_SESSION['msg'] = "Item(s) has been deleted successfull!";
		$this -> redirect($_COOKIE['re_dir']);
	}
	
	function buildForm( $data=array() , $msg = ''){
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task']);
		$form -> setDefaults( $data );
		
		$form -> addElement('text', 'name', 'Name', array('size' => 50, 'maxlength' => 255));
		$form -> addElement('textarea', 'permission', 'Description', array('rows'=> 10, "cols"=> 80));
		
		$btn_group[] = $form -> createElement('submit',null,'Save',array("style"=> "border:1px solid gray; padding:0 10px 0 10px;"));		
        $btn_group[] = $form -> createElement('button',null,'Go Back',array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'', "style"=> "border:1px solid gray;"));
      
        $form -> addGroup($btn_group);
      
		$form->addElement('hidden', 'id', $data['id']);
		
        $form -> addRule('name','Name cannot be blank','required',null,'client');
		
		if( $form -> validate() ){
			if( !$_POST['id'] ){				
				 $this -> vsDb -> insert($_POST);
				 $_SESSION['msg'] = "Item has been inserted at ". date('Y-m-d h:i:s');
			}else {
				$id = $_POST['id'];
				$this -> vsDb -> updateWithPk($id, $_POST);
				$_SESSION['msg'] = "Item has been updated at ". date('Y-m-d h:i:s');
			}
			
			$this -> redirect($_COOKIE['re_dir']);
		}
		
		$form->display();

	}
	
	function listUserType( $sMsg = '')
	{		
		global $oDb;
		global $oDatagrid;				
		
		$this->getPath("User module >> Manage User Type >> List User Type");
		$submit_url= "?mod=admin&amod={$_GET['amod']}&atask={$_GET['atask']}";
		$oDatagrid->setMethod($submit_url);
		$table = "user_type ";
		$oDatagrid->setTable($table);
		 
		$oDatagrid->addField(array("field" => "id",	'display' => 'Id',"primary_key" =>true,"sortable" => true));
		$oDatagrid->addField(array("field" => "name","display" => "Name","link"	=> "{$submit_url}&task=edit","sortable" => true));
		$oDatagrid->addField(array("field" => "permission","display" => "Description","sortable" => true));
		$oDatagrid->addField(array("field" => "editable","visible" => "hidden"));
		
		$aAction = $this->getAct();
		$aAction[1]['display'] = array('field' => 'editable', 'operation' => 'equal', 'value' => '1');		
		$aAction[2]['display'] = array('field' => 'editable', 'operation' => 'equal', 'value' => '1');		
		
		$oDatagrid->setTask($aAction);
		$oDatagrid->addTask(array("tooltip" => "Assign Rolls to Group","action" => "open_win","icon" => "decentralize.png","display" => array('field' => 'editable', 'operation' => 'equal', 'value' => '1'))
		);
	#	print_r($aAction);
		if( $_SESSION['msg'] )
			$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset ( $_SESSION['msg'] );
		
		$oDatagrid->displayGrid();	
		
	}

	/**
	 * add module 
	 */
	function addModule($id)
	{
			
		global  $oSmarty, $oDb;
		
		//echo 'testabc';
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->delete($id);				
			if(!$id){					
				$_SESSION['post'] = $_POST ;
			}else{
				foreach ($_POST['module'] as $value)
				{												
					foreach ($_POST['roll'.$value] as $val)
					{		
						$this->insert($id, $val, $value);
					}
				}			
				echo '<script type="text/javascript">window.close();	</script>';
			}
		}
		
		$table = "admin_menu";
		$condition = " editable = 1";
		$order = "z_index";
		$modules = $this -> multiLevel( $table, "id", "parent_id", "*", "{$condition}", "{$order}");		
		//$modules = $oDb->getAll("SELECT * FROM admin_menu ");
		
		foreach ($modules as $key => $value)		
		{
			if( !$value['hashchild']){
				$modules[$key]['title'] = $this -> getPrefix($value['level']). $value['title'];			
				$rolls = array();
				$sql = "SELECT t1.*, t2.id as module_roll_id FROM tbl_roll t1 join (SELECT * FROM tbl_module_roll WHERE module_id='{$value['id']}') t2 on(t1.id=t2.roll_id) ORDER BY ordered";
				$rolls = $oDb->getAll($sql);			
				if( count( $rolls ) > 0)
				{
					foreach ($rolls as $k =>$v)
					{
						$sql = "SELECT id FROM tbl_usertype_moduleroll WHERE module_roll_id = {$v['module_roll_id']} AND user_type_id = '$id'";				
						$res = $oDb->getOne($sql);					
						if( $res > 0){
							$rolls[$k]['checked'] = true;
							$modules[$key]['checked'] = true;	
						}
					}
				}
				
				$modules[$key]['roll'] =$rolls;
			}
		}
		
		$oSmarty->assign("modules", $modules);
		#print_r($modules);
		$oSmarty->display('assign_module.tpl');
				
	}
	
	function insert($id, $roll, $module)
	{
		global $oDb;
		 $MRID = $oDb->getOne("SELECT id FROM tbl_module_roll WHERE module_id ='$module' and roll_id = '$roll'"); 
						
		if($MRID)
		{	
			$ar_usergroup = array(
				'module_roll_id' => $MRID,
				'user_type_id' => $id
			);	
								
			$oDb->autoExecute("tbl_usertype_moduleroll",$ar_usergroup,DB_AUTOQUERY_INSERT);										}				
	}
	
	function delete($id)
	{		
		global $oDb;
		$sql = "DELETE FROM tbl_usertype_moduleroll WHERE user_type_id =".$id;
		$oDb->query($sql);	
	}
	
	
}

?>