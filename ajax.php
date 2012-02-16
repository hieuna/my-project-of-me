<?php
include 'includes/define.table.php';
include 'inc/function.php';
include 'includes/functions_email.php';
include 'includes/functions_general.php';
error_reporting(0);

$task			= $_GET['task'];
if ($task =='search'){
	$q = strtolower($_GET["txtKeyword"]);
	$sql = "SELECT p.product_id AS product_id, p.price AS price, p.image AS image, p.model AS model, d.name AS name FROM product AS p, product_description AS d WHERE p.product_id=d.product_id";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result)){
		$i++;
		$link = "index.php?route=product/product&product_id=".$row["product_id"];
		?>
			<a class="result_over" href="<?php echo $link;?>"><?php echo $row["name"];?></a><b><?php echo number_format(intval($row["price"]), 0, ',', '.');?> VNĐ</b>
		<?php
	}
}
else if ($task == 'viewproduct'){
	$id		 	= intval($_GET['id']);
	if ($id == 1){
		session_start();
		$session_cart = $_SESSION["cart"];
		$total_cart = count($session_cart);
		if ($total_cart > 0){
			$condition = "(";
			$i = 0;
			foreach ($session_cart as $key => $value) {
				//echo "Key: $key; Value: $value<br />\n";
				$i++;
				if ($i == $total_cart) $str = "";
				else $str = ",";
				$condition .= $key.$str;
			}
			$condition .= ")";
			$sql = "SELECT p.product_id AS product_id, p.price AS price, p.image AS image, p.model AS model, d.name AS name FROM product AS p, product_description AS d WHERE p.product_id=d.product_id AND p.product_id IN ".$condition;
			$result = mysql_query($sql);
			?>
			<table cellpadding="0" cellspacing="0" class="cart_tb">
				<thead>
					<tr>
						<td class="first">Ảnh sản phẩm</td>
						<td>Tên sản phẩm</td>
						<td>Model</td>
						<td>Số lượng</td>
						<td>Giá tiền</td>
						<td class="last">Tổng tiền</td>
					</tr>
				</thead>
				<tbody>
					<?php
					$sum_money = 0;
					while ($row = mysql_fetch_array($result)){
					$link = "index.php?route=product/product&product_id=".$row["product_id"];
					?>
					<tr>
						<td class="first"><a href="<?php echo $link;?>"><img src="<?php echo HTTP_IMAGE; echo $row["image"]?>" /></a></td>
						<td><a href="<?php echo $link;?>"><?php echo $row["name"];?></a></td>
						<td><?php echo $row["model"];?></td>
						<td style="text-align: center; font-size:13px;">
							<b>
							<?php 
							foreach ($session_cart as $key => $value) {
								if ($row["product_id"] == $key) echo $value;
								//echo "Key: $key; Value: $value<br />\n";
							}
							?>
							</b>
						</td>
						<td><b><?php echo number_format(intval($row["price"]), 0, ',', '.');?> VNĐ</b></td>
						<td class="last">
							<b style="color: red;">
							<?php
							foreach ($session_cart as $key => $value) {
								if ($row["product_id"] == $key){
									$sum = $row["price"]* $value;
									echo number_format($sum, 0, ',', '.')." VNĐ"; 
								}	
							}
							?>
							</b>
						</td>
					</tr>
					<?php
					$sum_money = $sum_money + $sum;
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6" class="first last" style="text-align: right;">
							<b>Tổng tiền thanh toán :</b>
							<b style="color: red;">
							<?php
							echo number_format($sum_money, 0, ',', '.')." VNĐ"; 
							?>
							</b>
						</td>
					</tr>
					<tr>
						<td colspan="3" class="first">
							<a class="button_sm txtTextBox" onclick="location = 'index.php?route=product/category&amp;path=20'"><span>Tiếp tục mua hàng</span></a>
						</td>
						<td colspan="3" class="last">
							<a class="button_sm txtTextBox" onclick="location = 'index.php?route=checkout/shipping'"><span>Đặt mua</span></a>
						</td>
					</tr>
				</tfoot>
			</table>
			<script type="text/javascript">
			$(function(){
				$("#tab_content, #box-cart").css("height", "auto");
				$("#box-cart").addClass("clearfix");
				$(".click-slide-prev, .click-slide").hide();
			});
			</script>
			<?php
		}
	}else{
		$sql = "SELECT p.product_id AS product_id, p.price AS price, p.image AS image, d.name AS name FROM product AS p, product_description AS d WHERE p.product_id=d.product_id AND p.status=1 AND p.price>0 LIMIT 15";
		$result = mysql_query($sql);
		$i = 0;
		echo '<ul>';
		while ($row = mysql_fetch_array($result)){
			$i++;
			$link = "index.php?route=product/product&product_id=".$row["product_id"];
			?>
			<li>
				<div>
					<a href="<?php echo $link;?>">
					<?php if ($row["image"] != ""){?>
					<img src="<?php echo HTTP_IMAGE; echo $row["image"]?>" width="110" />
					<?php }else{?>
					<img src="<?php echo HTTP_IMAGE;?>cache/no_image-225x315.jpg" width="110" />
					<?php }?>
					</a>
				</div>
				<div><a href="<?php echo $link;?>"><?php echo $row["name"];?></a></div>
				<div><b><?php echo number_format(intval($row["price"]), 0, ',', '.');?> VNĐ</b></div>
			</li>
			<?php
			if ($i%6 == 0){
				echo '</ul>';
				echo '<ul>';
			}
		}
		echo '</ul>';
		?>
		<script type="text/javascript">
		$(function(){
			$("#tab_content, #box-cart").css("height", "250px");
			$("#box-cart").removeClass("clearfix");
			$(".click-slide-prev, .click-slide").show();
		});
		</script>
		<?php
	}	
} 
//Đăng ký email khuyến mãi
else if ($task == 'subscribe'){
	$email		= mysql_real_escape_string($_GET['email']);
	$check 		= isEmail($email);
	if ($check == 0){
		 echo '<b style="color:red;">Email bạn nhập không hợp lệ!</b>';
	}else{
		$sql = "SELECT COUNT(*) AS total FROM ".TBL_SUBSCRIBE." WHERE email = '".$email."'";
		$query = mysql_query($sql);
		$result = mysql_fetch_assoc($query);
		$total = $result['total'];
		
		if ($total == 0){
			$subject = "Enter your subject here";
			$message = "Enter your message here";
			if(mail($email, $subject, $message, "From: $email")){
				$sql = "INSERT ".TBL_SUBSCRIBE." (email, status) VALUES ('".$email."', 1)";
				mysql_query($sql);
				echo 'Email <b>'.$email.'</b> đã được cập nhật nhận thông báo khuyến mãi!';
				echo "The email has been sent.";
			}
		}else{
			echo 'Email <b>'.$email.'</b> đã tồn tại trong hệ thống gửi thông báo khuyến mãi của chúng tôi !';
		}
	}
}
//Dang ky
else if ($task == 'register'){
	//var_dump($data); die;
	$firstname		= mysql_real_escape_string($data[0]);
	$lastname		= mysql_real_escape_string($data[1]);
	$email			= mysql_real_escape_string($data[2]);
	$username		= mysql_real_escape_string($data[3]);
	$password		= mysql_real_escape_string($data[4]);
	$phone			= mysql_real_escape_string($data[5]);
	$address		= mysql_real_escape_string($data[6]);
	$ip			 	= getRealIpAddr();
	$time			= time();
	$date			= date("Y-m-d h:s:i", $time);
	
	//count email
	$sql = "SELECT COUNT(*) AS total FROM user WHERE email = '".$email."'";
	$query = mysql_query($sql);
	$result = mysql_fetch_assoc($query);
	$total_email = $result['total'];
	//count username
	$sql2 = "SELECT COUNT(*) AS total FROM user WHERE username = '".$username."'";
	$query2 = mysql_query($sql2);
	$result2 = mysql_fetch_assoc($query2);
	$total_username = $result2['total'];
	if ($total_email > 0){
		echo '<font color="red">Email <b>'.$email.'</b> đã tồn tại trong hệ thống của chúng tôi !</font>';
		die;
	}else if ($total_username > 0){
		echo '<font color="red">Tên đăng nhập <b>'.$username.'</b> đã tồn tại trong hệ thống của chúng tôi, vui lòng thử tên đăng nhập khác !</font>';
		die;
	}else{
		$sql = "INSERT INTO user(user_group_id, username, password, firstname, lastname, email, status, ip, date_added, phone, address)
							VALUES(13, '".$username."', '".md5($password)."', '".$firstname."', '".$lastname."', '".$email."', 0, '".$ip."', '".$date."', '".$phone."', '".$address."')
		"
		;
		if (mysql_query($sql)){
			echo '<p><b>Xin chúc mừng bạn đã đăng ký tài khoản thành công tại hệ thống của chúng tôi !</b></p>';
		}else{
			echo '<b style="color:red;">Có lỗi hệ thống xảy ra trong quá trình đăng ký, vui lòng thử lại !</b>';
		}
	}
}
//login
else if ($task == "login"){
	$username		= mysql_real_escape_string($data[0]);
	$password		= md5(mysql_real_escape_string($data[1]));
	
	$sql = "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."'";
	$query = mysql_query($sql);
	$result = mysql_fetch_assoc($query);
	if ($result["username"] != ""){
		session_start();
		$_SESSION['username']=$result["username"];
		echo 'Xin chào, '.$_SESSION['username'];
		//echo $s
	}else{
		echo 'Tên đăng nhập hoặc mật khẩu không chính xác !';
	}
}
//vote
else if ($task == "vote"){
	session_start();
	session_id();
	$ip=$_SERVER['REMOTE_ADDR'];
	
	if($_GET['id'])
	{
		$id=$_GET['id'];
		$id = mysql_escape_String($id);
		$sql = "SELECT ip_add FROM ".TBL_VOTE." WHERE ip_add='$ip' AND session_id='".session_id()."'";
		//echo $sql;
		//die;
		$ip_sql=mysql_query($sql);
		$count=mysql_num_rows($ip_sql);
		if($count==0)
		{
			// Insert IP address and Message Id in Voting_IP table.
			$sql_in = "insert into ".TBL_VOTE." (session_id, ip_add, value) values ('".session_id()."','$ip', ".$id.")";
			mysql_query($sql_in);
			echo "<script>alert('Cảm ơn bạn đã đánh giá');</script>";
		}
		else
		{
			echo "<script>alert('Bạn đã bỏ phiếu rồi');</script>";
		}
	}
}

//HOT DEAL
if ($task == "customer"){
	$hotdeal_id		= intval($_REQUEST["hotdeal_id"]);
	
	$sql = "SELECT * FROM ".TBL_CUSTOMER_HOTDEAL." WHERE hotdeal_id=".$hotdeal_id." ORDER BY id DESC";
	$result = mysql_query($sql);
	echo '<div class="ls_content_cus css3-lsCustomer">';
		echo '<div class="title css3-radius-title">Danh sách khách hàng <span class="close_cus" id="close_'.$hotdeal_id.'"></span></div>';
		echo '<div class="main_ls_cus" style="overflow:auto;">';
			echo '<ul>';
			$i = 0;
			while($array = mysql_fetch_array($result)){
				$i++;
				if ($array["name"] == ""){
					$name = "Khách hàng giấu tên";
				}else{
					$name = $array["name"];
				}
				if ($array["date"] == "0000-00-00 00:00:00") $date = "";
				else $date = unFormatDate($array["date"], "d/m/Y h:i:s");
				echo '<li class="clearfix"><span>'.$i.'/</span><span class="name">'.$name.'</span><span class="date">'.$date.'</span></li>';
			}
			echo '</ul>';
		echo '</div>';
	echo '</div>';
	echo '<div class="icon-row"></div>';
	?>
	<script type="text/javascript">
	$(function(){
		$("#close_<?php echo $hotdeal_id;?>").click(function(){
        	$("#cus_<?php echo $hotdeal_id;?>").fadeOut('slow');
        });
	});
	</script>
	<?php
}
?>	