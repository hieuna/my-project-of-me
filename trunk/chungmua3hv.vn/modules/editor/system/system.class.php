<?php
class SystemBack extends VS_Module_Base  
{
	var $table;
	var $pk;
	var $_prefix;
	var $arr_fields;
	var $mod;
	function __construct() {
		@eval(getGlobalVars()); 
		parent::__construct($oDb);
		$this -> table = "tblsystem";
		$this->_prefix ="System_";
		$this->pk =  $this->_prefix.'ID';			
		$this -> vsDb -> setTable( $this->table );	
		$this->imagePath = "upload/system";
		if($this->isPost())
		$this->arr_fields = array(
			$this->_prefix.'Name' 		=> stripcslashes($_POST[$this->_prefix.'Name']),
			$this->_prefix.'Value' 		=>$_POST[$this->_prefix.'Value'],
			$this->_prefix.'Description'=>$_POST[$this->_prefix.'Description'],
		);
		
	}
	
	function run( $task )
	{		
		
		switch ( $task )
		{
			default:
				$this -> listSystem();
				break;
			case 'add':
				$this -> addSystem() ;
				break;
			case 'edit':
				$this -> editSystem();
				break;
			case 'delete':
				$this -> deleteSystem();
				break;
			
		}
		
	}
	
	function listSystem()
	{
		global $oDb;
		global $oDatagrid;			
	
		$this->getPath($this->get_config_vars('list_root_system'));						
		$submit_url= "?mod=admin&amod=system&atask=".$this->mod;
		$oDatagrid->setMethod($submit_url);
		$oDatagrid->setTable($this->table);
		
		$oDatagrid->addField(array("field" => $this->_prefix."ID","primary_key" =>true,"visible"=>"hidden"));
		$oDatagrid->addField(array("field" => $this->_prefix."Name","display" => $this->get_config_vars('title'),"link"	=> "{$submit_url}&task=edit"));
		$oDatagrid->addField(array("field"	=> $this->_prefix."Value","display"	=> $this->get_config_vars('value')));
				
		$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset( $_SESSION['msg'] );
		
		$arrAct = array($this -> getAct('edit'), $this -> getAct('delete'));
		$oDatagrid->setTask($arrAct);
	
		$oDatagrid->displayGrid();
	}
	
	function addSystem()	
	{
		$this -> getPath( $this->get_config_vars('add_root_'.$this->mod));
		$this -> buildForm('add');
	}
	
	function editSystem()
	{
		$id = intval($_GET['id']);		
		$this -> getPath($this->get_config_vars('edit_root_'.$this->mod));
		$row = $this->vsDb->getRow($id);	
		$this -> buildForm( 'edit', $row );
	}
	
	
	function deleteSystem()
	{
		$id = $_GET['id'];
		$this -> vsDb -> deleteWithPk ($id);
		$_SESSION['msg'] =$this->get_config_vars('msg_delete');
		$this -> redirect($_COOKIE['re_dir']);		
	}
	
		

		
	function buildForm ( $task, $arrData = array() )
	{
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
		
		if( $task == "edit" ){
			$form->setDefaults($arrData);
		}
		
			
		$form -> addElement('text', $this->_prefix.'Name',  $this->get_config_vars('title'), array('size' => 50, 'maxlength' => 255) );
		switch($arrData[$this->_prefix.'Type']){			
			case 'number':
				$form -> addElement('textarea', $this->_prefix.'Value',  $this->get_config_vars('value'), array('rows' => 5, 'cols' => 80));
				$form -> addRule( $this->_prefix.'Value',$this->get_config_vars('value').$this->get_config_vars('no_number'),'numeric',null,'client' );
				break;
			case 'select':
				if($arrData[$this->_prefix.'GroupValue']){
					$aGroupValue = explode("||",$arrData[$this->_prefix.'GroupValue']);
					foreach ($aGroupValue as $val){
						$aData[$val] = $val;
					}
					$form -> addElement('select', $this->_prefix.'Value',  $this->get_config_vars('value'), $aData );
				}
				break;
				
			case 'date':
				$form -> addElement('date', $this->_prefix.'Value', $this->get_config_vars('value'), array("minYear" => date('Y') - 50, "maxYear" => date('Y') + 10,"format" => "d - M - Y"));
				break;
			case 'photo':
				$form->addElement('file', 'photo', $this->get_config_vars('photo'));
				if($arrData[$this->_prefix.'Value']){
					$sImage = "<image src = '".SITE_URL.$this->imagePath."/".$arrData[$this->_prefix.'Value']."' style = 'width:150px;'>";
					$form->addElement('static', null,null, $sImage);
					$form->addElement('hidden', 'oldPhoto', $arrData[$this->_prefix.'Value']);
				}
				break;
			case 'text':
				default:
				$form -> addElement('textarea', $this->_prefix.'Value',  $this->get_config_vars('value'), array('rows' => 5, 'cols' => 80));
				break;
			
		}
		
		$form -> addElement('textarea', $this->_prefix.'Description',  $this->get_config_vars('summarize'), array('rows' => 5, 'cols' => 80));
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );
		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);
		
		$form->addElement( 'hidden', 'id', $arrData[$this->_prefix.'ID'] );
		
		$form -> addRule( $this->_prefix.'Name',$this->get_config_vars('title').$this->get_config_vars('no_blank'),'required',null,'client' );		
		
		if( $form -> validate())
		{
			$arr = $this->arr_fields;
			
			if($_FILES['photo']['name']){
				if($_POST['oldPhoto']) $this->unlinkPhoto($_POST['oldPhoto']);
				$arr[$this->_prefix.'Value'] = $this->uploadPhoto();
			}elseif(is_array($_POST[$this->_prefix.'Value'])){
				$arr[$this->_prefix.'Value'] = $_POST[$this->_prefix.'Value']['Y'] . "-" . $_POST[$this->_prefix.'Value']['M'] . "-". $_POST[$this->_prefix.'Value']['d'];
			}
			
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
	
	function unlinkPhoto( $sImage )
	{
		if( $sImage )
		{
			@unlink($this->imagePath."/{$sImage}");			
		}
	}

	function uploadPhoto ()
	{
		include(SITE_DIR."classes/image.class.php");
		$folder = $this->imagePath;
		$filename = $_FILES['photo']['name'];
		$file = CImage::uploadFile($_FILES['photo']['tmp_name'], $filename, $folder);
		return $file;
	}
	
}
?>
