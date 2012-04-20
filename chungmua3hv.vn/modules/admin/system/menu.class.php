<?php
class MenuBack extends VS_Module_Base  
{
	var $table;
	var $pk;
	var $_prefix;
	var $arr_fields;
	var $mod;
	function __construct() {
		@eval(getGlobalVars()); 
		parent::__construct($oDb);
		$this -> table = "tblmenu";
		$this->_prefix ="";
		$this->pk =  $this->_prefix.'id';			
		$this -> vsDb -> setTable( $this->table );	
		
		if($this->isPost())
		$this->arr_fields = array(
			$this->_prefix.'title' 			=> stripcslashes($_POST[$this->_prefix.'title']),
			$this->_prefix.'link' 		=>$_POST[$this->_prefix.'link'],
			$this->_prefix.'position' 		=>$_POST[$this->_prefix.'position'],
			$this->_prefix.'z_index' 		=>$_POST[$this->_prefix.'z_index'],
			$this->_prefix.'status' 		=>$_POST[$this->_prefix.'status'],
			$this->_prefix.'description' 		=>$_POST[$this->_prefix.'description'],
		);
	}
	
	function run( $task )
	{		
		
		switch ( $task )
		{
			default:
				$this -> listItem();
				break;
			case 'add':
				$this -> addItem() ;
				break;
			case 'edit':
				$this -> editItem();
				break;
			case 'delete':
				$this -> deleteItem();
				break;
			
		}
		
	}
	
	function listItem()
	{
		global $oDb;
		global $oDatagrid;			
	
		$this->getPath($this->get_config_vars('list_root_system'));						
		$submit_url= "?mod=admin&amod=system&atask=".$this->mod;
		$oDatagrid->setMethod($submit_url);
		$oDatagrid->setTable($this->table);
		
		$oDatagrid->addField(array("field" => $this->_prefix."id","primary_key" =>true,"visible"=>"hidden"));
		$oDatagrid->addField(array("field" => $this->_prefix."title","display" => $this->get_config_vars('title'),"link"	=> "{$submit_url}&task=edit"));
		$oDatagrid->addField(array("field"	=> $this->_prefix."link","display"	=> $this->get_config_vars('link')));
		$oDatagrid->addField(array("field"	=> $this->_prefix."position","display"	=> $this->get_config_vars('position')));
		$oDatagrid->addField(array("field"	=> $this->_prefix."z_index","display"	=> $this->get_config_vars('order'), 'datatype'=>"order"));
		$oDatagrid->addField(array("field"	=> $this->_prefix."status","display"	=> $this->get_config_vars('status')));
				
		$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset( $_SESSION['msg'] );
		
		$oDatagrid->setTask($this->getAct());
	
		$oDatagrid->displayGrid();
	}
	
	function addItem()	
	{
		$this -> getPath( $this->get_config_vars('add_root_'.$this->mod));
		$this -> buildForm('add');
	}
	
	function editItem()
	{
		$id = intval($_GET['id']);		
		$this -> getPath($this->get_config_vars('edit_root_'.$this->mod));
		$row = $this->vsDb->getRow($id);	
		$this -> buildForm( 'edit', $row );
	}
	
	
	function deleteItem()
	{
		$id = $_GET['id'];
		$this -> vsDb -> deleteWithPk ($id);
		$_SESSION['msg'] =$this->get_config_vars('msg_delete');
		$this -> redirect($_COOKIE['re_dir']);		
	}
	
	function saveOrder(){	
		$aItem = $_GET['z_index'];
		if(is_array($aItem) && count( $aItem ) > 0){
			// save order for item.
			foreach( $aItem as $key => $value){
				if( !is_numeric($value)) $value = 0;				
				$this -> vsDb -> updateWithPk( $key, array('z_index' => $value ));
			}
		}	
		$msg = "Item(s) has been save order successfull!";
		$this -> listItem( $msg );
	}		

		
	function buildForm ( $task, $arrData = array() )
	{
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
		
		if( $task == "edit" ){
			$form->setDefaults($arrData);
		}
		
		$aPosition = array('top' => 'Top', 'left'=> 'Left', 'right' => 'Right');
			
		$form -> addElement('text', $this->_prefix.'title',  $this->get_config_vars('title'), array('size' => 50, 'maxlength' => 255));		
		
		$form -> addElement('text', $this->_prefix.'link',  $this->get_config_vars('link'), array('size' => 50, 'maxlength' => 255) );		
		
		$form -> addElement('select', $this->_prefix.'position',  $this->get_config_vars('position'), $aPosition);		
		
		$form -> addElement('text', $this->_prefix.'z_index',  $this->get_config_vars('order'), array('size' => 50, 'maxlength' => 255) );		
		
		$form -> addElement('checkbox', $this->_prefix.'status',  $this->get_config_vars('status') );		
		
		$form -> addElement('textarea', $this->_prefix.'description',  $this->get_config_vars('summarize'), array('rows' => 5, 'cols' => 80));
		
		
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );
		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);
		
		$form->addElement( 'hidden', 'id', $arrData[$this->_prefix.'id'] );
		
		$form -> addRule( $this->_prefix.'title',$this->get_config_vars('title').$this->get_config_vars('no_blank'),'required',null,'client' );		
		
		$form -> addRule( $this->_prefix.'link',$this->get_config_vars('link').$this->get_config_vars('invalid'),'weblink' );	
		$form -> addRule( $this->_prefix.'z_index',$this->get_config_vars('order').$this->get_config_vars('is_numeric'),'numeric' );		
	
		
		if( $form -> validate())
		{
			$arr = $this->arr_fields;			
			
			if( $_POST['id'] == '' )
			{		 	
				 $this -> vsDb ->insert($arr);
				$_SESSION['msg'] = $this->get_config_vars('msg_insert');
			}
			else 		
			{	
				$this -> vsDb ->updateWithPk($_POST['id'],$arr);
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');
			}
			$this -> redirect($_COOKIE['re_dir']);
		}
		
		$form->display();
		
	}
	
}
?>
