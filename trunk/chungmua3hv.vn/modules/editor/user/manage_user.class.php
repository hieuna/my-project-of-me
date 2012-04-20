<?php
class manage_user extends Bsg_module_base {	

	function __construct(){
		global $oDb;
		parent::__construct( $oDb );
		$this -> vsDb -> setTable('user');
	}
	
	function addUser()
	{
		$this -> getPath( $this->get_config_vars('add_root_user'));
		$this -> buildForm();
	}
	
	function editUser()
	{		
		$id = $_GET['id'];		
		$this -> getPath( $this->get_config_vars('edit_root_user').": {$id}");
		$row = $this -> vsDb -> getRow( $id );
		if($row){
			$row['dob'] = date('dMY', strtotime( $row['dob'] ));
			$row['password'] = '';
		}
		
		$this -> buildForm( $row, 'edit' );
	}

	function deleteUser()
	{
		$id = $_GET["id"];		
		$this -> vsDb -> deleteWithPk( $id );
		$msg = "Item has been deleted at ". date('Y-m-d h:i:s');
		$this -> listUser( $msg );
	}
	
	function deleteMultiUser()
	{
		$aItems	 = $_GET['arr_check'];
		if(is_array( $aItems) && count( $aItems) > 0){
			$sItems = implode( ',', $aItems );
			$this -> vsDb -> deleteWithPk( $sItems );
		}
		$msg = "Item(s) has been deleted successfull!";
		$this -> listUser( $msg );
	}
	
	function getUserType(){
		global $oDb;
		$sTbl = "user_type";
		$query = "SELECT id, name FROM {$sTbl} WHERE 1";
		$result = $oDb -> getAssoc( $query );
		return $result;
	}
	
	function buildForm( $data=array() , $msg = ''){
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'],'', "style='padding:10px 15px 0 20px;'" );
		$form -> setDefaults( $data );
		
		$aUserType = $this -> getUserType();
		
		$form -> addElement('text', 'username', $this->get_config_vars('username'), array('size' => 60, 'maxlength' => 40));
		$form -> addElement('text', 'email', $this->get_config_vars('email'), array('size' => 60));
		$form -> addElement('select', 'user_type_id', $this->get_config_vars('user_type'), $aUserType);
		$form -> addElement('password', 'password', $this->get_config_vars('password'), array('size' => 40));
		$form -> addElement('password', 'repassword', $this->get_config_vars('retype_password'), array('size' => 40));		
		$form -> addElement('text', 'phone', $this->get_config_vars('phone'), array('size' => 40,'maxlength' => 12));
		$form -> addElement('textarea', 'address', $this->get_config_vars('address'), array('cols' => 60, 'rows' => 5));
		$form -> addElement('checkbox', 'gender', $this->get_config_vars('gender'));		
		$form -> addElement('date', 'dob', $this->get_config_vars('date_of_birth'), array("minYear" => 1960, "maxYear" => 2010,"format" => "d - M - Y"));
		$form -> addElement('checkbox', 'active', $this->get_config_vars('active'));		
		
		$btn_group[] = $form -> createElement('submit',null,$this->get_config_vars('save'),array("style"=> "border:1px solid gray; padding:0 10px 0 10px;"));		
        $btn_group[] = $form -> createElement('button',null,$this->get_config_vars('btn_back'),array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'', "style"=> "border:1px solid gray;"));      
        $form -> addGroup($btn_group);
		      
		$form->addElement('hidden', 'id', $data['id']);
		$form->addElement('hidden', 'oldUser', $data['username']);		
		$form->addElement('hidden', 'oldEmail', $data['email']);
		$form -> addRule('username', $this->get_config_vars('require_user'), 'required', null, 'client');
		$form -> addRule('email', $this->get_config_vars('require_email'), 'required', null, 'client');
		$form -> addRule('email', $this->get_config_vars('email_invalid'), 'email', null, 'client');
		$form->addRule(array('password', 'repassword'), $this->get_config_vars('password_match'), 'compare', null, 'client');
		
		if( $msg!= 'edit' ){
			$form -> addRule ('password', $this->get_config_vars('require_password'), 'required', null, 'client');
			$form -> addRule('repassword', $this->get_config_vars('require_repassword'), 'required', null, 'client');
			
		}
		$form -> registerRule("existUser", "callback","checkExistUser", "manage_user");
		$form -> addRule('username', $this->get_config_vars('user_registered'), "existUser", null, "server");
		
		$form -> registerRule("existEmail", "callback","checkExistEmail", "manage_user");
		$form -> addRule('email', $this->get_config_vars('email_registered'), "existEmail", null, "server");
		
		
		if( $form -> validate() ){
			$data = array(
				"username" => $_POST['username'],
				"email" => $_POST['email'],
				'user_type_id' => $_POST['user_type_id'],
				'phone'	=> $_POST['phone'],
				'address' => $_POST['address'],
				'gender' => $_POST['gender'],				
				'active' => $_POST['active']
			);			
			$date = "{$_POST['dob']['Y']}-{$_POST['dob']['M']}-{$_POST['dob']['d']}";
			$data['dob'] = $date;
			
			if( !$_POST['id'] ){				
				$data['password'] = md5( $_POST['password'] );				
				$this -> vsDb -> insert( $data );
				$msg = $this->get_config_vars('msg_insert');
			}else {			
				$id = $_POST['id'];
				if( $_POST['password'] && $_POST['repassword']){
					$data['password'] = md5( $_POST['password'] );
				}
				
				$this -> vsDb -> updateWithPk($id, $data);
				$msg = $this->get_config_vars('msg_edit');
			}
			
			$this -> redirect($_COOKIE['re_dir']. "&msg={$msg}");
		}
		
		$form->display();

	}
	
	function checkExistUser( $username='' ){
		global $oDb;
		$sTbl = 'user';
		$oldUser = $_POST['oldUser'];
		if( $oldUser != '' && $username == $oldUser )
			return true; 
		$query = "SELECT * FROM {$sTbl}  WHERE username='$username'";		
		$row = $oDb -> getRow( $query );
		if( is_array($row) && count( $row ) > 0 ){
			return false;
		}		
		return true;
	}
	
	function checkExistEmail( $email='' ){
		global $oDb;
		$sTbl = 'user';
		$oldEmail = $_POST['oldEmail'];
		if( $oldEmail != '' && $email == $oldEmail )
			return true; 
		$query = "SELECT * FROM {$sTbl}  WHERE email='$email'";		
		$row = $oDb -> getRow( $query );
		if( is_array($row) && count( $row ) > 0 ){
			return false;
		}		
		return true;
	}
	
	function listUser( $sMsg = "")
	{		
		global $oDb;
		global $oDatagrid;				
		
		$this->getPath($this->get_config_vars('list_root_user'));
		$submit_url= "?mod=admin&amod=user&atask=user";
		$oDatagrid->setMethod($submit_url);
		$table = "(SELECT * FROM user) as user ";
		$oDatagrid->setTable($table);
		
		$oDatagrid->addFilter(array("field"=>array("id"=> array('ID','number'),'username'=>array('Username','text')),"name"=>"filter_group","type"=>"number","selected"=> $_REQUEST["filter_group"]
			));
			
		$oDatagrid->addFilter(array("field"	=>"user_type_id","display"=> $this->get_config_vars('user_type'),"name"=> "user_type_id","selected"=> isset($_REQUEST["user_type_id"])?$_REQUEST["user_type_id"]:"","options"=> $oDb->getAssoc("select id, name from user_type")));
		$oDatagrid->addFilter(array("field"	=> "create_date","display"=> $this->get_config_vars('create_date'),"name"=> "create_date","type"=> "date","selected" 	=> isset($_REQUEST["create_date"])?$_REQUEST["create_date"]:$startdate));
		$oDatagrid->addFilter(array("field"	=>"active","display" => $this->get_config_vars('active'),"name"	=> "active","selected"=> isset($_REQUEST["active"])?$_REQUEST["active"]:"","options" 	=> array('1'=>"Yes",'0'=> "No")));
		
		$oDatagrid->addField(array("field" => "id",	"display" => $this->get_config_vars('id'),"primary_key" =>true,"sortable" => true));
		$oDatagrid->addField(array("field"=>"username","display"=>$this->get_config_vars('username'),"link"=>"{$submit_url}&task=edit","sortable"=> true));
		$oDatagrid->addField(array("field" => "email","display" => $this->get_config_vars('email'),"sortable" => true));
		$oDatagrid->addField(array("field" => "create_date","display" => $this->get_config_vars('create_date'),	"datatype" => "datetime","sortable" => true));
		$oDatagrid->addField(array("field"=> "user_type_id","display" => $this->get_config_vars('user_type'),"sql"=> "select name from user_type where user_type.id=user_type_id","sortable"=> true));
		$oDatagrid->addField(array("field" => "active","display" => $this->get_config_vars('active'),"datatype" => "publish","sortable" => true));
		
		$oDatagrid->addTaskAll(array("task" => "multi_delete","display" => "Delete"));
		
		$aAction = $this->getAct();				
		
		$aAction[1]['display'] = array('field' => 'user_type_id', 'operation' => 'notequal', 'value' => 'super admin');		
		$aAction[2]['display'] = array('field' => 'user_type_id', 'operation' => 'notequal', 'value' => 'super admin');		
		$oDatagrid->setTask($aAction);
		if( $sMsg )
			$oDatagrid -> setMessage( $sMsg );
		
		$oDatagrid->displayGrid();
	}		
	
}

?>