<?php
class poll
{
	function run($task= "")
	{	
		$this->session=base64_encode(session_id());
	 	switch ($task){
	 		default:
	 			$this->showPoll();	
	 			break;	
	 		case 'stats':
	 			$this -> view_stats();
	 			break; 	
	 		case 'poll':			
				$this -> pollAction($_GET['pollid'],$_GET['answer']);
				break;		
	 	}
    }
    
    function showPoll()
    {
    	global $oDb, $oSmarty;
    	
    	$lang_id = $_SESSION['lang_id'];	
		if(isset($_SESSION[$this->session])){		
			$sCondition = " AND Poll_ID not in({$_SESSION[session_id()]})";
		}
    	$sql = "SELECT Poll_ID,Poll_Question FROM tblpoll WHERE Poll_Status = '1' and Poll_LangID='{$lang_id}'  ORDER BY rand() LIMIT 1";
		$pollQuestion = $oDb -> getRow($sql);
		//print_r($pollQuestion);
		if($pollQuestion){
			$sql = "SELECT Vote_ID, Vote_Answer FROM tblvote WHERE Vote_PollID = '{$pollQuestion['Poll_ID']}' ORDER BY Vote_ID ASC";			
			$pollAnswer = $oDb -> getAssoc($sql);		
		}else{
			$sql = "SELECT Poll_ID,Poll_Question FROM tblpoll WHERE Poll_Status = '1' and Poll_LangID='{$lang_id}' ORDER BY rand() LIMIT 1";
			$pollQuestion = $oDb -> getRow($sql);
		}	
		if(isset($_SESSION[$this->session])){		
			$aPoll = explode(",",$_SESSION[$this->session]);				
			if(in_array($pollQuestion['Poll_ID'],$aPoll)){
				$oSmarty -> assign("hide",1);
			}
		}
		 //echo "dsdsd";
		$oSmarty -> assign("pollQuestion",$pollQuestion);
		$oSmarty -> assign("pollAnswer",$pollAnswer);		
		
		$oSmarty -> display('showPoll.tpl');	
    }
    
    function pollAction( $pollID=0,$sAnswers='')
    {		
    	global $oDb;
    	if($sAnswers!=''){
    		$sAnswers = str_replace("||",",", $sAnswers). "0";
    		$sql = "UPDATE tblvote SET Vote_Number = Vote_Number + 1 WHERE Vote_ID in ({$sAnswers})";
			$res = $oDb -> query($sql);
			if(isset($_SESSION[$this->session]))
				$_SESSION[$this->session] .= ','.$pollID;
			else
				$_SESSION[$this->session] = $pollID;	
    	}
    	
    	echo 1;
		
	}
    
	
	function view_stats()
	{	
		global $oDb, $oSmarty;
		//echo 'test';
		$maxWidth = 350;
		$id = $_GET['id'];
		$sql = "SELECT * FROM tblpoll WHERE Poll_ID = '$id'";
		$pollQuestion =  $oDb -> getRow($sql);		
		#print_r($pollQuestion); die;
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
			$oSmarty -> assign("pollQuestion",$pollQuestion);
			$oSmarty -> assign("pollAnswer",$pollAnswer);
		}
		
		$oSmarty->assign("totalVote",$totalVote);
		$oSmarty -> display("statsPoll.tpl");
	}
	
}
?>