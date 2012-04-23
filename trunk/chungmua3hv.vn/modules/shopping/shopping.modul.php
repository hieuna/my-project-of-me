<?php
class shopping extends VS_Module_Base
{	
	function __construct(){
			@eval(getGlobalVars()); 
			parent::__construct($oDb,$oSmarty);
			$this->table="tbl_shopping";
			$this->type='product';
			$this->_prefix="Shopping_";
			$timemow= mktime();
			$this->vsDb->setTable($this->table);	
			$this->vsDb->setPrimaryKey($this->_prefix."ID");
			$this->where=" where {$this->_prefix}Status='1' and {$this->_prefix}EndDate >= '{$timemow}' ";
			if($_COOKIE["DID"])
				$this->where.=" and  {$this->_prefix}DestinationID='".$_COOKIE["DID"]."' ";
			
	}
	function run($task="")
	{	
		switch($task)
		{
			case "insert":
				$this->insertDefault(intval($_GET["ID"])); break;
			case "method":
				$this->selectMethod(intval($_GET["ID"])); break;
			case "check":
				$this->checkInformation(intval($_GET["pmt_SID"])); break;
			case "report":
				$this->reportForm($_GET["codeID"]); break;
			case "send":
				$this->sendInformation(intval($_GET["id"])); break;
			case "add":
				$this->addItem(intval($_GET["pmt_ID"])); break;
			case "sohapay":
				$this->payment_sohapay(); break;	
			default: 
				header("Location:".SITE_URL);
			 break;
		}
	
	}
	function getPageinfo($task){
		global $oSmarty;
		$aPageinfo['title'] =" Đăng ký mua hàng | ". $oSmarty->get_config_vars("title_home");
		$aPageinfo['keyword'] = "";
		$aPageinfo['description'] = "";
		return $aPageinfo;
	}
	function sendInformation($id)
	{
		//echo 'hehe';
		$shopping = $this->getRow(" select *  from {$this->table} where {$this->_prefix}ID='{$id}'");
		$product = $this->getRow("select * from tblproduct where Product_ID='".$shopping[$this->_prefix."ProductID"]."'");
		$sp = $product['Product_Deal'];
		$email = $shopping['Shopping_Email'];
		$price = number_format($product['Product_DealPrice']);
		$total = number_format($shopping['Shopping_Total']);
		$_check="";
		if($shopping['Shopping_Type']=='Thanh toán tại nhà'){
			$_check="<p>Do Quý khách đã chọn hình thức thanh toán Giao hàng và Nhận tiền tại nhà, do vậy trong vòng 2-7 ngày Muachung sẽ giao phiếu/sản phẩm tại địa chỉ nhận hàng của Quý khách, sau đó sẽ thu tiền. Nếu tại thời điểm giao hàng Quý khách không có mặt, ChungMua3hv sẽ gọi điện xác nhận lại hoặc mang hàng ngược trở lại.</p>
Tổng số tiền Quý khách cần thanh toán là: <b>$total</b> đ. ";
		}
		$link = "
		<p><strong>Xin chào quý khách,</strong></p>
<p>Trước hết xin cảm ơn quý khách đã quan tâm và mua hàng tại website http://chungmua3hv.vn của công ty <strong>Công ty TNHH Thương Mại VHH Hà Nội</strong> chúng tôi.</p>
<p>Dưới đây là thông tin đơn hàng mà quý khách đã đặt mua trên website.</p>
		<div style=\"background: none repeat scroll 0 0 #FFFFFF;border: 2px solid #FFFFFF;clear: both;margin-bottom: 10px;margin-left: 10px;padding: 10px;\">
                    <div style=\"font-family: Times New Roman,Times,serif;font-size: 19px;padding: 0 0 0 25px;\">Thông tin đơn hàng</div>			
    
    <table cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #DBCCA9;color: #4E4238;margin: 15px 0 0;\" width=\"100%\">
                	<col width=\"50%\" /><col width=\"50%\" />
                	<tr style=\"background: none repeat scroll 0 0 #F9F3E3;\">
                    	<th style=\"text-align:left;border-right: 1px solid #DBCCA9;padding: 8px;\">MÃ SỐ ĐƠN HÀNG</th>
                    	<th style=\"text-align:left;padding: 8px;\">{$shopping['Shopping_Code']}</th>
       	            </tr>
                </table>
                </div>
                <div style=\"background: none repeat scroll 0 0 #FFFFFF;border: 2px solid #FFFFFF;clear: both;margin-bottom: 10px;margin-left: 10px;padding: 10px;\">
                    <div style=\"font-family: Times New Roman,Times,serif;font-size: 19px;padding: 0 0 0 25px;\">Thông tin sản phẩm </div>			
    
    <table cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #DBCCA9;color: #4E4238;margin: 15px 0 0;\" width=\"100%\">
                	<col width=\"5%\" /><col width=\"50%\" /><col width=\"10%\" /><col width=\"15%\" /><col width=\"15%\" />
                	<tr style=\"background: none repeat scroll 0 0 #F9F3E3;\">
                    	<th style=\"text-align:left;border-right: 1px solid #DBCCA9;padding: 8px;\">STT</th>
                    	<th style=\"text-align:left;border-right: 1px solid #DBCCA9;padding: 8px;\">Thông tin chi tiết</th>
                    	<th style=\"text-align:left;border-right: 1px solid #DBCCA9;padding: 8px;\">Số lượng</th>
                    	<th style=\"text-align:left;border-right: 1px solid #DBCCA9;padding: 8px;\">Giá mua</th>
                    	<th style=\"text-align:left;padding: 8px;\">Thành tiền</th>
                    </tr>
                	<tr>
                    	<td style=\"text-align:left;padding: 8px;border-right: 1px solid #DBCCA9;\">1</td>
                    	<td style=\"text-align:left;padding: 8px;border-right: 1px solid #DBCCA9;\">{$product['Product_Name']}</td>
                    	<td style=\"text-align:left;padding: 8px;border-right: 1px solid #DBCCA9;\">
                        	{$shopping['Shopping_Quantity']}
                        </td>
                    	<td style=\"text-align:left;padding: 8px;border-right: 1px solid #DBCCA9;\">{$price}</td>
                    	<td style=\"text-align:left;padding: 8px;\">{$total}</td>                        
                    </tr>					
                </table>
               </div>

               <div style=\"background: none repeat scroll 0 0 #FFFFFF;border: 2px solid #FFFFFF;clear: both;margin-bottom: 10px;margin-left: 10px;padding: 10px;\">
       
                        <div style=\"font-family: Times New Roman,Times,serif;font-size: 19px;padding: 0 0 0 25px;\">Thông tin khách hàng </div>	
      <table cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #DBCCA9;color: #4E4238;margin: 15px 0 0;\" width=\"100%\">
                	<col width=\"40%\" /><col width=\"60%\" />
                	<tr style=\"background: none repeat scroll 0 0 #F9F3E3;\">
                    	<th style=\"text-align:left;border-right: 1px solid #DBCCA9;padding: 8px;\" >Tên khách hàng</th>
                    	<th  style=\"text-align:left;padding: 8px;\">{$shopping['Shopping_Name']}</th>
                    </tr>
                	<tr>
                    	<td  style=\"text-align:left;padding: 8px;border-right: 1px solid #DBCCA9;border-top: 1px solid #DBCCA9;\">Địa chỉ email</td>
                    	<td  style=\"text-align:left;padding: 8px;border-top: 1px solid #DBCCA9;\">{$shopping['Shopping_Email']}</td>
                    </tr>
                	<tr style=\"background: none repeat scroll 0 0 #F9F3E3;\">
                    	<th  style=\"text-align:left;padding: 8px;border-right: 1px solid #DBCCA9;border-top: 1px solid #DBCCA9;\">Số điện thoại liên hệ</th>
                    	<th  style=\"text-align:left;padding: 8px;border-top: 1px solid #DBCCA9;\">{$shopping['Shopping_Phone']}</th>
                    </tr>
                	<tr>
                    	<td  style=\"text-align:left;padding: 8px;border-right: 1px solid #DBCCA9;border-top: 1px solid #DBCCA9;\">Địa chỉ nhận hàng</td>
                    	<td  style=\"text-align:left;padding: 8px;border-top: 1px solid #DBCCA9;\">{$shopping['Shopping_Address']}</td>
                    </tr>
                  	<tr style=\"background: none repeat scroll 0 0 #F9F3E3;\">
                    	<th  style=\"text-align:left;padding: 8px;border-right: 1px solid #DBCCA9;border-top: 1px solid #DBCCA9;\">Hình thức thanh toán</th>
                    	<th  style=\"text-align:left;padding: 8px;border-top: 1px solid #DBCCA9;\">{$shopping['Shopping_Type']}</th>
                    </tr>
              </table>
          
                </div>
				{$_check}
				<p> <em>Xin quý khách xác nhận lại thông tin và xin lưu lại email này cho đến khi nhận được sản phẩm.</em></p>
				";
//echo $link;
		$this->query("update tblproduct set Product_Buy=Product_Buy+1 where Product_ID ='".$shopping[$this->_prefix."ProductID"]."'");
		$this->sendMail('sendorder','Xác nhận đơn hàng mã số '.$shopping['Shopping_Code'].' tại chungmua3hv.vn',$email,$link);
		
	}
	function checkInformation($id){
	$this->sendInformation($id);
			$shopping = $this->getRow(" select *  from {$this->table} where {$this->_prefix}ID='{$id}'");
			$product = $this->getRow("select * from tblproduct where Product_ID='".$shopping[$this->_prefix."ProductID"]."'");
			//print_r($product);
			$this->assign("shopping",$shopping);
			$this->assign("product",$product);
			
		$this->display("shopping_show_information.tpl");
	
	}
	function insertDefault($id){
		$session= session_id();
		header("Location:".SITE_URL."pmt_method.php?ID=$id&pmt_session=$session"); exit();
	}
	function selectMethod($ID){
		//$product = $this->getRow("select * from tblproduct where Product_ID='{$ID}'");
		//$this->assign("product",$product);
		$this->display("shopping_select_method.tpl");
	}
	function addItem($ID){
		if($_SERVER['REQUEST_METHOD']=='POST'){
				$_SESSION["member"]["name"] =  $_POST["frmName"];
				$_SESSION["member"]["phone"] =  $_POST["frmPhone"];
				$_SESSION["member"]["address"] =  $_POST["frmAddress"];
				$_SESSION["member"]["email"] =  $_POST["frmEmail"];
					
			
			if($_POST["frmSecure"]==$_SESSION['key_captcha']){
				$aData= array(
					$this->_prefix."Name" =>       $_SESSION["member"]["name"],
					$this->_prefix."Phone" =>      $_SESSION["member"]["phone"],
					$this->_prefix."Address"  =>   $_SESSION["member"]["address"],
					$this->_prefix."Email" =>      $_SESSION["member"]["email"],
					$this->_prefix."Quantity" =>   $_POST["frmQuality"],
					$this->_prefix."Create" =>      mktime(),
					$this->_prefix."Total" =>      $_POST["frmTtotal"],
					$this->_prefix."City" =>      $_POST["city"],
					$this->_prefix."Gender" =>      0,
					$this->_prefix."Complete" =>      0,
					$this->_prefix."Type" =>      $_POST["frmPayType"],
					$this->_prefix."ProductID" =>  $_POST["frmProductID"],
					$this->_prefix."SessionID" =>  session_id()
				);
				$aData[$this->_prefix."Code"] = "CM". date("dmy",$aData[$this->_prefix."Create"]);
				
				$_id= $this->vsDb->insert($aData);
				$__code = $aData[$this->_prefix."Code"].$_id;
				$this->query("update {$this->table} set {$this->_prefix}Code = '{$__code}' where {$this->_prefix}ID='{$_id}'");
				
				//print_r($aData);
				header("Location:".SITE_URL."pmt_information.php?pmt_SID=$_id&pmt_session=".session_id()); exit();
			}else{
			 echo "<script>
alert(\"Bạn nhập sai mã bảo mật.\"); 
</script>
";
			}
			
		}
		$product = $this->getRow("select * from tblproduct where Product_ID='{$ID}'");
		$this->assign("product",$product);
		
		$this->setParent(&$arrPanrent,$idt,0,'',$lang_id,'city');
		$this->assign("city",$arrPanrent);
		
		$this->display("shopping_detail.tpl");
	}
	
	//PAYMENT WITH SOHAPAY
	function payment_sohapay(){
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			include_once 'class_payment.php';	
			
			$return_url = $pg_root_url.'/payment_info.php';
			$ship = $_POST['vs_Ship'];
			$transaction_info = $_POST['vs_Name_Booking'].' + 10% VAT + Phí Ship sản phẩm này là: '.number_format($ship, 0, '.', ',');
			$order_code = $_POST['vs_ShoppingCode'];
			$price_product = $_POST['vs_Price'];
			$vat	= ($price_product*10)/100;
			$price = $price_product+$vat+$ship;
			if ($_POST['vs_email'] == '') $order_email = 'chungmua3hv@gmail.com';
			else $order_email = $_POST['vs_email'];
			if ($_POST['vs_mobile'] == '') $order_mobile = '';
			else $order_mobile = $_POST['vs_mobile'];

			$sohapay = new PG_checkout();
			$url = $sohapay->buildCheckoutUrl($return_url, $transaction_info, $order_code, $price, $order_email, $order_mobile);
			header('Location:' . $url);
		}
	}
	//END PAYMENT WITH SOHAPAY
	
	function reportForm($code){
		if($_GET["type"]){
			if($_GET["type"]=='1'){
				$this->display("shopping_report_1.tpl");
			}
			if($_GET["type"]=='2'){
				$this->display("shopping_report_2.tpl");
			}
			if($_GET["type"]=='3'){
				$this->display("shopping_report_3.tpl");
			}
			exit();
		}
		$result = $_GET["vs_return"];
		if($result>=0){
			if($result==1)
			{
	//	echo "dsđ"; exit();
				// thanh cong 
				//echo $result; exit();
				header("Location:".SITE_URL."shopping/mua-hang-thanh-cong.php"); exit();
			}
			elseif($result==2){
				header("Location:".SITE_URL."shopping/mua-hang-that-bai.php"); exit();
			
			}else{
			
				header("Location:".SITE_URL."shopping/mua-hang-khong-xac-dinh.php"); exit();
			}
		}
		//$this->display("shopping_report.tpl");
	}
	
	
		function setParent(&$arrPanrent,$id,$idp=0,$text='',$lang_id=0,$type='', $partten = " --- ")

	{		

		global $oDb;

		$stbl = 'tblgroup';

		// type of category

		if ($type == '') $type = $_GET['atask'];

		// default sql where

		$sWhere = "Group_ParentID={$idp} and Group_Type='{$type}'";

		// if use language

		if ($this->islang){

			$sWhere .= " and Group_LangID = '".$lang_id."'";			

		}

		//if has id of current item, get other item

		if($id){

			$sWhere.= " and Group_ID<>{$id}";

		}

		

		$sql="select Group_ID,Group_Name from {$stbl} where {$sWhere}";	

		$rows=$oDb->getAll($sql);		

		if(count($rows)){

		  	foreach($rows as $row)

		    {

				 $arrPanrent[$row["Group_ID"]] =$text. $row["Group_Name"];

				 $this->setParent($arrPanrent,$id,$row["Group_ID"],$text.$partten,$lang_id,$type);

			}

		}

	}



}
?>