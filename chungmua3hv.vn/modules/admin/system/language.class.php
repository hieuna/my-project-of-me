<?php
/************************************************
**
**	date 06/12/2008
**	Engine class blog.
**	Developed by hotrungdungit@gmail.com
**  BSG vietnam Co Ltd-.
**
************************************************/

	class CLang extends VS_Module_Base
	{
		function __construct(){
			@eval(getGlobalVars());
			parent::__construct( $oDb );
			$sTbl = "lang";
			$this -> vsDb -> setTable( $sTbl );
		}
        
        function listLang( $msg= '')
		{
			global $oDatagrid;		
			
			$this->getPath($this->get_config_vars('list_root_'.$_GET['atask']));			
			$oDatagrid->setTable($this -> vsDb -> getTable());
			$submit_url= "?mod=admin&amod={$_REQUEST['amod']}&atask={$_REQUEST['atask']}";
			$oDatagrid->setMethod($submit_url);
			
			$oDatagrid->addField(array("field" => "id","display" => $this->get_config_vars('id'),"primary_key" => true,"sortable" => true));
			$oDatagrid->addField(array("field" => "name","display" => $this->get_config_vars('name'),"link"	=> "{$submit_url}&task=edit","sortable" => true));
			$oDatagrid->addField(array("field" => "filename","display" => $this->get_config_vars('file_config'),"sortable" => true));
			$oDatagrid->addField(array("field" => "isdefault","display" => $this->get_config_vars('default'),"datatype" => "boolean"));
						
			if( $msg ) $oDatagrid -> setMessage( $msg );
			$act2 = $this-> getActionEdit();
			$act3 = $this-> getActionDelete();
			$result = array( 	$act2,$act3	);
			$oDatagrid->setTask($result);
			$oDatagrid->addTask(array("task"=>"set_default","icon"=>"tick.png","tooltip"=>$this->get_config_vars("toltip_default"),"confirm"=>$this->get_config_vars("default_lang_confim")));

			$oDatagrid -> displayGrid();
		}

		function buildForm($data, $type = '')
		{
			
			$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '');			
			
			$form -> setDefaults( $data );
			
			$form -> addElement("text","name",$this->get_config_vars("name"),array("style" => "width:400px"));
			$aAttributes['style'] = "width:400px";
			if( $data['filename'])
				$aAttributes['readonly'] = "readonly";
			$form -> addElement("text","filename","{$this->get_config_vars('file_config')}<div style='font-size:11px; font-weight:normal; color:#666666'>(config_file.conf)</div>", $aAttributes);
			$form -> addElement('textarea', "content", $this->get_config_vars("content_file_config"), array("style" => "width:600px; height:600px;"));
			$btn_group[] = $form -> createElement('submit',null,$this->get_config_vars('save'),array("style"=> "border:1px solid gray; padding:0 5px 0 5px;"));		
        	$btn_group[] = $form -> createElement('button',null,$this->get_config_vars('btn_back'),array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'', "style"=> "border:1px solid gray;"));      
			$form -> addGroup($btn_group);
			$form->addElement('hidden', 'id', $data['id']);	
			$form -> addRule("name", $this->get_config_vars('require_name'), 'required');
			$form -> addRule("filename", $this->get_config_vars('require_file'), 'required');
			//$reg = "/[a-zA-Z0-9\_]+$/";
			//$form -> addRule('name', "Name can not contain special character or space", 'regex', $reg);
			
			if($data['id'])
			{
				$form -> registerRule("existLang", "callback","checkExistLang", "CLang");
				$form -> addRule('name', $this->get_config_vars('lang_exist'), "existLang", null, "server");
			}
			
			
			if($form -> validate())
			{
				$data = array(
					"name" => $_POST['name'],
					"filename" => $_POST['filename']
				);
				
				if( !$_POST['id'] )
				{	
					$this -> createFile( $data['filename'] );
					$this -> write_file_config($data['filename'],$_POST['content']);
					$this -> vsDb -> insert($data);
				 	$this->get_config_vars('msg_insert');
				}
				else
				{
					$id = $_POST['id'];
					//@unlink(SITE_DIR."languages/".$data['filename']);
					$this -> write_file_config($data['filename'],$_POST['content']);
					$this -> vsDb -> updateWithPk($id, $data);
					$_SESSION['msg'] = $this->get_config_vars('msg_edit');
				}
				
				parent::redirect($_COOKIE['re_dir']."&msg={$msg}");
			}
			
			$form -> display();
		}
		
		function checkExistLang( $langName='' ){
			global $oDb;
			$sTbl = 'lang';
			
			$query = "SELECT * FROM {$sTbl}  WHERE name='{$langName}'";		
			$row = $oDb -> getRow( $query );
			if( is_array($row) && count( $row ) > 0 ){
				return false;
			}		
			return true;
		}
		
		function addLang()
		{
			global $oDb;
			$this -> getPath( $this->get_config_vars('add_root_'.$_GET['atask']));
			$data = array();
			$table = $this -> vsDb -> getTable();
			$sql = "select filename from {$table} where `isdefault` ='1'";
			$default_file = $oDb -> getOne($sql);
			
			$data['content'] = $this -> read_file_config($default_file);			
			$this -> buildForm($data,'');
		}
		
		function editLang()
		{
			$id = $_GET['id'];
			$this -> getPath( $this->get_config_vars('edit_root_'.$_GET['atask']). ": {$id}");			
			$result = $this -> vsDb -> getRow( $id );
			
			$result['content'] = $this -> read_file_config($result['filename']);			
			$this -> buildForm($result, 'edit');
		}	
		
		function deleteLang($id)
		{
			global $oDb ;
			$table = $this -> vsDb -> getTable();
			if($id){			
				$sql = "select * from {$table} where id = '$id'";
				$aLang = $oDb -> getRow($sql);
				if( $aLang['isdefault'] == '1'){
					$msg = "You can not delete language default";
					$this -> listLang( $msg );
					return;
				}
				$conf_file = $aLang['filename'];
				if($conf_file)
				{
					$file_path = SITE_DIR."languages/".$conf_file;
					if(is_file($file_path))
					{
						@unlink($file_path);
					}
				}
				
				$sql = "delete from {$table} where id = '$id'";
				$res = $oDb -> query($sql);
				$msg = "Item has been deleted at ". date('Y-m-d h:i:s');
				$this -> listLang($msg);
				//parent::redirect($_COOKIE['re_dir']);
			}
		}
		
		function setDefault( $langId ){
			global $oDb;			
			if( $langId ){
				$table = $this->vsDb->getTable();
				$sql = "select id from {$table} where id='$langId'";
				$check = $oDb -> getOne( $sql );
				if( $check ){
					$sql = "update {$table} set isdefault='0' where 1";
					$oDb ->query($sql);
					$sql = "update {$table} set isdefault='1' where id='{$langId}'";
					$oDb -> query($sql);
				}else{
					$msg = "Language is not exist !";
					$this -> listLang( $msg );
					return;
				}
			}else{
				$msg = "No Language is selected !";
				$this -> listLang( $msg );
				return;
			}
			
			$msg = "Language has been save as default lang at ". date('Y-m-d h:i:s');
			$this -> listLang( $msg );
			return;
		}
		
		function read_file_config($filename)
		{
			$file_path = SITE_DIR."languages/".$filename;
			if(is_file($file_path))
			{
				$handle = fopen($file_path,'r');
				$filesize = filesize($file_path);
				if($filesize)
					$contents = fread($handle, $filesize);	
				else $contents="";
				fclose($handle);
			}
			return $contents;		
		}
		
		function write_file_config($filename,$content)
		{
			$file_path = SITE_DIR."languages/".$filename;			
			$handle = fopen($file_path,'w');
			$contents = fwrite($handle, $content);	
			fclose($handle);				
		}
		
		function createFile( $filename ){
			global $oDb ;
			if( $filename != ''){
				$table = $this -> vsDb -> getTable();
				$sql = "select filename from {$table} where `isdefault` ='1'";
				$default_file = $oDb -> getOne($sql);
				$sSourceFile = SITE_DIR."languages/".$default_file;				
				$sDesFile = SITE_DIR."languages/".$filename;
				@copy( $sSourceFile, $sDesFile); 
				@chmod( $sDesFile, 0777);				
			}
		}
	}
?>