<?php
class buydeals extends VS_Module_Base  
{
	
		function __construct(){
			@eval(getGlobalVars()); 
			parent::__construct($oDb,$oSmarty);
		}
	
		function run($task)
		{	
			$session= session_id();
				switch ($task)
				{				
					case 'step2':				
						$this->Buy_Deals_Step_2($_GET['DealID'],$session);					
						break;
					case 'paid':				
						$this->payment();					
						break;
				/*	case 'step3':				
						$this->Buy_Deals_Step_3($_GET['ShopID'],$session);					
						break;*/
					default:
						$this->Buy_Deals_Step_1($_GET['DealID'],$session);
						break;
					
				}
		 }
	 
		function  Buy_Deals_Step_1($id,$session){
			global $oSmarty;
			//$id = $_GET['DealsID'];
			if($_SESSION[_BUSINESS]["ShoppingID"]){
					$guest_reg= $this->db->getRow("select * from tbl_shopping where Shopping_ID='".$_SESSION[_BUSINESS]["ShoppingID"]."'");
				$this->assign("guest_reg",$guest_reg);
				
			}
			//echo $_SESSION[_BUSINESS]["ShoppingID"];
			/*if(($_SESSION[_BUSINESS]["ProductID"]) == $id)
			{
					$stt = $_SESSION[_BUSINESS]["ShoppingID"];
					$this->assign("action",$stt);
			}
			else
			{
					$stt = 'ad';
					$this->assign("action",$stt);
			}*/
			$this->display("Buy_Deals_Step1.tpl");
		}	
		function  Buy_Deals_Step_2($id,$session){			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$dealsID=$_POST['DealsID'];				
				$price=$this->db->getOne("select Product_DealPrice from tblproduct where Product_ID ='{$dealsID}'");
				//print_r($price);
				if(is_numeric($price)){
					$number=$_POST['quantity'];
					$total=$price*$number;
					$aData= array(
					"Shopping_Email"=> $_POST['email'],
					"Shopping_Name"=> $_POST['name'],
					"Shopping_Create"=> $_POST['day'].'/'.$_POST['month'].'/'.$_POST['year'],
					"Shopping_ProductID"=> $dealsID,
					"Shopping_Messege"=> $_POST['dealarea'],
					"Shopping_Complete"=> 0,
					"Shopping_Type"=> 'deal',
					"Shopping_Total"=> $total,
					"Shopping_SessionID"=> $session,
					"Shopping_Quantity"=> $_POST['quantity']
					);
					$this -> vsDb -> setTable("tbl_shopping");
					$this-> vsDb ->setPrimaryKey("Shopping_ID");
					$action=$_POST["ac"];
					if($action=='ad')
						$id=$this->vsDb->insert($aData);
					else{
						$this->vsDb->UpdateWithPk($action,$aData);
						//$id=$action;
					}
						
					$_SESSION[_BUSINESS]["ShoppingID"] = $id;
					//$_SESSION[_BUSINESS]["ProductID"] = $dealsID;
			//echo "select Deals_Price from tbl_deals where Deals_ID='{$dealsID}'";
					//redirect(SITE_URL.'buydeals?task=step3&ShopID='.$id);
				}
			}
			
			$guest= $this->db->getRow("select * from tbl_shopping where Shopping_ID='{$id}'");
			$deals= $this->db->getRow("select * from tblproduct where Product_ID ='".$guest["Shopping_ProductID"]."'");
			$this->assign("guest",$guest);
			$this->assign("deals",$deals);
			$this->display("Buy_Deals_Step3.tpl");
		}	
		/*function  Buy_Deals_Step_3($id,$session){
			global $oSmarty;
			$guest= $this->db->getRow("select * from tbl_shopping where Shopping_ID='{$id}'");
			$deals= $this->db->getRow("select * from tbl_deals where Deals_ID='".$guest["Shopping_ProductID"]."'");
			$this->assign("guest",$guest);
			$this->assign("deals",$deals);
			$this->display("Buy_Deals_Step3.tpl");
		}	*/
		function payment()
		{
			global $oDb,$oSmarty;
			$pid = $_GET['id'];
			$sid = $_GET['sid'];
			$qty = $_GET['qty'];
			$table_product = 'tblproduct';
			$table_shopping = 'tbl_shopping';
			$pbuy = $oDb->getOne("select Product_Buy from tblproduct where Product_ID='{$pid}'");
			$qtybuy = $pbuy + $qty;
			$arr = array(
    			'Product_Buy' => $qtybuy,
			);
			$oDb->autoExecute($table_product, $arr,DB_AUTOQUERY_UPDATE,"Product_ID='".$pid."'");
			$arrsp = array(
    			'	Shopping_PayType' => 'paid',
			);
			$oDb->autoExecute($table_shopping, $arrsp,DB_AUTOQUERY_UPDATE,"Shopping_ID='".$sid."'");
			redirect(SITE_URL);
		}
}
?>