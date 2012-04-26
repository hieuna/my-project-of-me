<?
/*
Lưu ý rất quan trọng, đối với hđh 64bit - ip2long từ 0 -> 4,1 tỉ
							 đối với hđh 32bit - ip2long từ -2,1 tỉ -> 2,1 tỉ
Do vậy bảng IP ở OS 64bit phải sử dụng unsigned integer
*/

class denyconnect{
	//Timeout tính bằng s
	var $timeout = 16;
	//Tổng số connect cho phép trong tgian timeout
	var $total_connect 		= 20;
	var $deny_ip 		 		= "";
	var $max_allow_connect	= 25;
	var $reach_ban_limit		= 50;
	/*
	Khởi tạo class
	$total_connect : Max connect cho phép mặc định là 0
	*/
	function denyconnect($total_connect=0){
		//Kiểm tra total_connect nếu > 0 gán vào biến global
		if ($total_connect > 0) $this->total_connect = $total_connect; 
		
		//Nếu ip được tin tưởng => return
		//Thiết lập deny IP
		$this->deny_ip		= $_SERVER['REMOTE_ADDR'];
		
		
		$array_ip = array("58.",
								"61.28.",
								"65.110.",
								"69.13.",
								"115.",
								"116.",
								"117.",
								"118.",
								"119.",
								"120.",
								"122.",
								"123.",
								"124.",
								"125.",
								"126.",
								"127.",
								"134.159.",
								"169.211.",
								"172.",
								"192.",
								"195.",
								"196.",
								"197.",
								"198.",
								"199.",
								"200.",
								"201.",
								"202.",
								"203.",
								"204.",
								"205.",
								"206.",
								"210.",
								"218.100.",
								"219.",
								"220.",
								"221.",
								"222.",
								"223.",
								);
		
		$check_ip = 0;
		//Kiểm tra xem IP có nằm trong khỏang kiểm sóat hay ko?
		foreach ($array_ip as $m_key=>$m_value){
			//if (strpos($this->deny_ip,$m_value)!==false){
			if (strpos($this->deny_ip,$m_value)===0){
				$check_ip = 1;
				break;
			}
		}
		
		//echo $check_ip;
		//Nếu IP nằm trong khoảng kiểm soát
		if ($check_ip == 1){
			//Kiêm tra xem có bị ban vĩnh viễn ko?
			if(file_exists("ipbanned/" . ip2long($this->deny_ip) . ".cfn")){
				echo '<div align="center" style="font-family:Arial, Helvetica; font-size:12px">';
				echo 'Website &#273;ang b&#7843;o tr&#236; h&#7879; th&#7889;ng.<br />';
				echo 'Xin b&#7841;n vui l&#242;ng quay l&#7841;i v&#224;o l&#7847;n sau !';
				echo '</div>';
				//Save vào log file
				$filename = "ipbanned/ipdenyconnect.cfn";
				$handle = @fopen($filename, 'a');
				
				if (!$handle) exit();
				
				fwrite($handle, date("d/m/Y h:i:s A") . " - Banned /" . $this->reach_ban_limit . " - " . $this->deny_ip . " " . $_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'] . "\n");
				fclose($handle);	
				
				exit();
			}
			
			$today = getdate();
			$total_count = 0;

			//Đếm tổng số connect trong khoảng tgian timeout
			$db_count = new db_query("SELECT Count(*) AS count
											  FROM ip_denyconnect 
											  WHERE ip = " . ip2long($this->deny_ip) . " AND time >= " . ($today[0] - $this->timeout));
			if ($row = mysql_fetch_array($db_count->result)){
				$total_count = $row["count"];
			}
			
			//Nếu vượt qua ngưỡng cho phép time sẽ + thêm 1min nữa để ban vĩnh viễn trong 1min tới
			if ($total_count >= $this->max_allow_connect) $today[0] = $today[0] + 60;
			
			//Nếu đạt mức ban thì ghi ra file để ban vĩnh viễn
			if ($total_count >= $this->reach_ban_limit){
				$filename = "ipbanned/" . ip2long($this->deny_ip) . ".cfn";
				$handle = @fopen($filename, 'a');
				if (!$handle) exit();
				fwrite($handle, "Ban");
				fclose($handle);	
			}

			//insert IP vao database
			$db_insert = new db_execute("INSERT INTO ip_denyconnect VALUES(" . ip2long($this->deny_ip) . "," . $today[0] . ")");
			
			//Kiểm tra total_count nếu >= ngưỡng cho phép thì deny luôn
			if ($total_count >= $this->total_connect){
				//Đưa ra thông báo lỗi
				echo '<div align="center" style="font-family:Arial, Helvetica; font-size:12px">';
					echo 'B&#7841;n &#273;ang di chuy&#7875;n v&#7899;i t&#7889;c &#273;&#7897; c&#7911;a F1.<br />';
					echo 'H&#227;y d&#7915;ng l&#7841;i 30 gi&#226;y &#273;&#7875; n&#7841;p th&#234;m nhi&#234;n li&#7879;u tr&#432;&#7899;c khi ti&#7871;p t&#7909;c !';
				echo '</div>';
				//Save vào log file
				$filename = "ipbanned/ipdenyconnect.cfn";
				$handle = @fopen($filename, 'a');
				
				if (!$handle) exit();
				
				fwrite($handle, date("d/m/Y h:i:s A") . " - " . $total_count . "/" . $this->total_connect . " - " . $this->deny_ip . " " . $_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'] . "\n");
				fclose($handle);	
				
				exit();
			}
			
			unset($db_insert);
			unset($db_count);								  
		}
		
	}
	
}
?>