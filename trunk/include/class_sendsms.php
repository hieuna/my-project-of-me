<?php
defined('PG_PAGE') or die();

class PGSendSMS 
{
	private $secure_secret	= 'muachungsms';
	private $url_send_sms	= 'http://sms.todo.vn:11180/receiveSMS.php';
	
	public function send($phone = '', $text = '', $orderId = 0){
		$phone = str_replace(array(' ','.',',','+'), '', $phone);
		$listValidPhone = array('09'=>'849','012'=>'8412','016'=>'8416','849'=>'849','0188'=>'84188','0199'=>'84199','8412'=>'8412','8416'=>'8416','84188'=>'84188','84199'=>'84199');
		$isNum  = false;
		$phoneNew = $phone;
		foreach($listValidPhone as $k=>$v){
			$num = strlen($k);
			$checkNum = substr($phone,0,$num);
			
			if($k == $checkNum){
				$isNum = true;
				$phoneNew = substr($phone,$num,strlen($phone));
				$phoneNew = $listValidPhone[$checkNum].$phoneNew;
				break;
			}
		}
		if(!$isNum){
			return('invalid number');
		}
		
		// brandname moi khong gui dc cho viettel 
//		if($this->isvt($phoneNew)){
//			$kannel = 1;
//		}

		$text = self::strip_special_char(convertKhongdau($text));
		return $this->send_brandname($phoneNew, $text, $orderId);
		
	}
	
	public function send_brandname($phone = '', $text = '', $orderId = 0){
		global $database;
		if($phone != ''){
			if(strlen($phone) >= 10 && strlen($phone) <= 13){
				$command_code	= 'SHP';
				$user			= 'hungnn';
				$pass			= 'hungnn';
				$secure_secret	= 'muachungsms';
				$url			= 'http://222.255.8.122:8888/wsbr/wsdl/APIBR.wsdl';
				require_once('include/nusoap/nusoap.php');
				$client 	= new nusoap_client($url,true);
				$param = array('phone_number' => $phone,'command_code'=>$command_code,'info'=>$text,'user'=>$user,'pass'=>$pass);
				
				$client->call('sendTextBR',$param);
				$return = $client->responseData;
				$p = xml_parser_create();
				xml_parse_into_struct($p, $return, $xml);
				$smsId = 0;
				if($xml){
					$smsId = json_decode($xml[3]['value']);
				}
				
				if($smsId > 0){
					$database->db_query("INSERT INTO sms_report (phone, order_id, sms_id, content, send_time, status) VALUES  ('$phone', '$orderId', '$smsId', '$text', ".time().", 'insert')");
					return 'success';
				}
				else{
					$database->db_query("INSERT INTO sms_error (phone, error_text, content, type, site, created) VALUES  ('$phone', '".substr($return, 0, 200)."', '$text', 'brandname', '{$_SERVER['HTTP_HOST']}', '".time()."')");
					send_email('thangphamduy@vccorp.vn', NULL, '[SohaPay] Lỗi brandname lúc: '.date('h:i:s - d/m/Y'), '<b>Lỗi:</b> '.$return.' <br /><b>SĐT: </b>'.$phone.'  <br /><b>Nội dung sms gửi đi:</b> '.$text.'<br />Gửi từ sv: '.$_SERVER['SERVER_NAME']);
				}
				
				return $return;
			}
			else{
				return('invalid number');
			}
		}
		else{
			return false;
		}
	}
	
	private function isvt($phone = ''){
		$listPhone = array('097','098','016','8416','8497','8498');
		foreach($listPhone as $v){
			$num = strlen($v);
			$checkNum = substr($phone,0,$num);
			if($v == $checkNum){
				return true;
			}
		}
		return false;
	}
	private function ismb($phone = ''){
		$listPhone = array('090','093','0122','0126','0121','0128','0120','8490','8493','84122','84126','84121','84128','84120');
		foreach($listPhone as $v){
			$num = strlen($v);
			$checkNum = substr($phone,0,$num);
			if($v == $checkNum){
				return true;
			}
		}
		return false;
	}
	private function isvn($phone = ''){
		$listPhone = array('091','094','0123','0125','0127','8491','8494','84123','84125','84127');
		foreach($listPhone as $v){
			$num = strlen($v);
			$checkNum = substr($phone,0,$num);
			if($v == $checkNum){
				return true;
			}
		}
		return false;
	}
 	static function strip_special_char($t) {
		$t = preg_replace("/[^a-zA-Z0-9\/\n\s\._,:;-]/", '', $t);
        return trim($t);
    }
}
?>