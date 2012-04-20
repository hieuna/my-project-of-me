<script type="text/javascript">
	/*function redirectUrl(id){	
		location.href="index.php?mod=admin&amod=poll&atask=vote&question=" + id;	
	}*/
	function view_stats(id)
	{
		window.open('?mod=admin&amod=poll&task=view_stats&id='+id,"newwindow","width=600px,height=400px,resizeable=false");
	}
</script>
<?php
class pollBack extends VS_Module_Base  
{
	var $table;
	var $pk;
	var $_prefix;
	var $arr_fields;
	var $mod;
	function __construct() {
		@eval(getGlobalVars()); 
		parent::__construct($oDb);
		$this -> table = "tblpoll";
		$this->_prefix ="Poll_";
		$this->pk =  $this->_prefix.'ID';			
		$this -> vsDb -> setTable( $this->table );	
		
		if($this->isPost())
		$this->arr_fields = array(
			$this->_prefix.'Question' 			=> stripcslashes($_POST[$this->_prefix.'Question']),
			$this->_prefix.'Status' 			=> stripcslashes($_POST[$this->_prefix.'Status']),
			$this->_prefix.'LangID' 		=>$_POST[$this->_prefix.'LangID']?$_POST[$this->_prefix.'LangID']:$this->lang_id
						
		);
	}
	
	function run( $task )
	{		
		
		switch ( $task )
		{
			default:
				$this -> ListItem();
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
			case 'change_status':
				$this -> changeStatus();
				break;
			case 'view_stats':
				$this -> view_stats();
				break;
		}
		
	}
	
	function listItem()
	{
		global $oDb;
		global $oDatagrid;			
	
		$root_path = $this->get_config_vars('list_root_'.$this->mod);						
		$submit_url= "?mod=admin&amod=poll&atask=".$this->mod;
		
		$oDatagrid->setMethod($submit_url);
		$oDatagrid->setTable($this->table);
		
		$arr_cols= array(					
			array(
				"field" => $this->_prefix."ID",					
				"primary_key" =>true,
				"display" => $this->get_config_vars('id'),
				"sortable"=> true								
			),	
			array(
				"field" => $this->_prefix."Question",
				"display" => $this->get_config_vars('question'),				
				"datatype" => "text",
				
			),
			array(
				"field" =>$this->_prefix."Status",
				"display"	=> $this->get_config_vars("status"),
				"datatype"	=> "publish"
			
			)
		);		
		
		$oDatagrid->setField($arr_cols);
		
		if($this->islang){		
			$oDatagrid->addFilter(
				array(
				"field" 	=> $this->_prefix."LangID",
				"display" 	=> $this->get_config_vars('language'),
				"name" 		=> $this->_prefix."LangID",
				"type" 		=> "select",				
				"style" 	=> "width:160px;",
				"selected" 	=> isset($_REQUEST[$this->_prefix."LangID"])?$_REQUEST[$this->_prefix."LangID"]: '',
				"options"	=> $this->getAssocLang()
				)
			);			
		}
				
		$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset( $_SESSION['msg'] );
		
		$roll = $this -> getAct();
		$roll[3] = Array(
	            'task' 	=> 'question',
	            'icon' =>'view.gif',	          
	            'tooltip' => $this->get_config_vars('tooltip_poll_answer_question'),
	            'action' =>'view_stats'
	        );

		$oDatagrid->setTask($roll);
		
		$oDatagrid->displayGrid();		
		
	}
	
	function addItem()	
	{
		$this -> getPath( $this->get_config_vars('add_root_'.$this->mod));
		$this -> buildForm('add');
	}
	
	function editItem()
	{
		global $oDb;
		$id = intval($_GET['id']);		
		$this -> getPath($this->get_config_vars('edit_root_'.$this->mod).": {$id}");
		$row = $this->vsDb->getRow($id);
		
		$sQuery = "select Vote_ID, Vote_Answer from tblvote where Vote_PollID = '{$id}' ORDER BY Vote_ID";

		$rows = $oDb -> getAssoc($sQuery);
		$i = 0;
		foreach($rows as $key => $answer)
		{	
			$row['answer'.($i+1)] = $answer;
			$row['answer_id'.($i+1)] = $key;
			$i ++;
		}	
		$this -> buildForm( 'edit', $row );
	}
	
	
	function deleteItem()
	{
		$id = $_GET['id'];
		$this -> vsDb -> deleteWithPk ($id);
		$_SESSION['msg'] =$this->get_config_vars('msg_delete');
		$this -> redirect($_COOKIE['re_dir']);		
	}
	
	function changeStatus()
	{
		$id = $_GET['id'];
		$status = $_GET['status'];		
		$this -> vsDb -> updateWithPk ( $id, array ( $this->_prefix.'Status' => $status));		
		
	}		

		
	function buildForm ( $task, $arrData = array() )
	{
		global $oDb;
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
		
		if( $task == "edit" ){
			$form->setDefaults($arrData);
		}
		
		if($this->islang)
			$form -> addElement('select', $this->_prefix.'LangID', $this->get_config_vars('language'),$this->getAssocLang(), array('width' => 200) );
		
		$form -> addElement('textarea', $this->_prefix.'Question',  $this->get_config_vars('question'), array('rows'=>5,'cols'=>70) );
		
		$form -> addElement("text", "answer1", "Answer 1",  array('size' => 50, 'maxlength' => 255));
		$form -> addElement("text", "answer2", "Answer 2",  array('size' => 50, 'maxlength' => 255));
		$form -> addElement("text", "answer3", "Answer 3",  array('size' => 50, 'maxlength' => 255));
		$form -> addElement("text", "answer4", "Answer 4",  array('size' => 50, 'maxlength' => 255));
		$form -> addElement("text", "answer5", "Answer 5",  array('size' => 50, 'maxlength' => 255));
		$form -> addElement("text", "answer6", "Answer 6",  array('size' => 50, 'maxlength' => 255));
		
		$form -> addElement("static", null,'',"(<i style=\"font-size:11px;\">{$this->get_config_vars('help_poll')})</i>");
		
		$form -> addElement('checkbox', $this->_prefix.'Status',  $this->get_config_vars('status') );
		
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );
		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);
	
		$form->addElement( 'hidden', 'id', $arrData[$this->_prefix.'ID'] );
		if( $task == 'edit' )
		{				
			$hidden[] = $form->createElement("hidden", "id1", $arrData['answer_id1']);
			$hidden[] = $form->createElement("hidden", "id2", $arrData['answer_id2']);
			$hidden[] = $form->createElement("hidden", "id3", $arrData['answer_id3']);
			$hidden[] = $form->createElement("hidden", "id4", $arrData['answer_id4']);
			$hidden[] = $form->createElement("hidden", "id5", $arrData['answer_id5']);
			$form -> addGroup($hidden);
		}
		
		$form -> addRule( $this->_prefix.'Title',$this->get_config_vars('title').$this->get_config_vars('no_blank'),'required',null,'client' );
		$form -> addRule( 'answer1',$this->get_config_vars('error_answer'),'required',null,'client' );
		
		if( $form -> validate())
		{
			
			if( $_POST['id'] == '' )
			{					 	
				$idQuestion = $this -> vsDb ->insert($this->arr_fields);
				$data = array(
							"Vote_PollID"	=> $idQuestion,
							"Vote_Answer"	=> $_POST['answer1']
						);
				$oDb -> autoExecute('tblvote',$data,DB_AUTOQUERY_INSERT);
				
				for($i = 2;$i<=5;$i++)
				{
					$ans =  'answer'.$i;
					if($_POST[$ans] != '')
					{
						$data = array(
							"Vote_PollID"	=> $idQuestion,
							"Vote_Answer"	=> $_POST[$ans]
						);
						$this -> vsDb -> setTable('tblvote');	
						$oDb -> autoExecute('tblvote', $data, DB_AUTOQUERY_INSERT);
					}
				}
				
				$_SESSION['msg'] = $this->get_config_vars('msg_insert');
			}
			else 		
			{	
				$this -> vsDb ->updateWithPk($_POST['id'],$this->arr_fields);	
				
				$idQuestion = intval($_POST['id']);			
				for( $i = 1; $i<=5; $i++ )
				{
					$where = " 	Vote_ID = ".intval($_POST['id'.$i]);
					
					if( ($_POST['id'.$i]!= '') && ($_POST['answer'.$i] != ''))
					{
						$data = array(
							"Vote_PollID"	=> $idQuestion,
							"Vote_Answer"	=> $_POST['answer'.$i]
						);
						$oDb -> autoExecute('tblvote', $data, DB_AUTOQUERY_UPDATE, $where );
					}
					elseif(($_POST['id'.$i] == '') && ($_POST['answer'.$i] != ''))
					{
						$data = array(
							"Vote_PollID"	=> $idQuestion,
							"Vote_Answer"	=> $_POST['answer'.$i]
						);						
						$oDb -> autoExecute('tblvote', $data, DB_AUTOQUERY_INSERT);	
											
					}
					elseif (($_POST['id'.$i] != '') && ($_POST['answer'.$i] == ''))
					{
						$sql = "DELETE FROM tblvote WHERE Vote_ID = '".$_POST['id'.$i]."'";						
						$oDb -> query($sql);
					}
				}
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');
			}
			$this -> redirect($_COOKIE['re_dir']);
		}
		
		$form->display();
		
	}
	
	function view_stats()
	{	
		global $oDb, $oSmarty;
		//echo 'test';
		$maxWidth = 350;
		$id = $_GET['id'];
		$sql = "SELECT * FROM tblpoll WHERE Poll_ID = '$id'";
		$pollQuestion =  $oDb -> getRow($sql);		
		//print_r($pollQuestion); die;
		if($pollQuestion){
			$sql = "SELECT * FROM tblvote WHERE Vote_PollID = '$id' ORDER BY  Vote_ID asc";
			$pollAnswer = $oDb -> getAll($sql);
			foreach ($pollAnswer as $k=>$v){
				$totalVote += $v['Vote_Number'];
			}
			if($totalVote > 0){
				if($pollAnswer){
					foreach($pollAnswer as $key => $val){
						$pollAnswer[$key]['percent'] = round(($val['Vote_Number']/$totalVote)*100,2);
						$pollAnswer[$key]['width'] = floor(($val['Vote_Number']/$totalVote)*$maxWidth);						
					}
				}
			}	
			$pollQuestion["total_poll"]	=	$totalVote;
			$oSmarty -> assign("pollQuestion",$pollQuestion);
			$oSmarty -> assign("pollAnswer",$pollAnswer);
		}
		
		$oSmarty -> display("view_statsPoll.tpl");
	}	
	
}
?>
