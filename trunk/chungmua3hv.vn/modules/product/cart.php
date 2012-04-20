<?php
	include_once '../data.php';
	include_once '../baokim_lib/commons.php';
	include_once '../baokim_lib/BaoKimPayment.php';
	session_start();
		//session_register("cart");
		
	if (array_key_exists('cart', $_SESSION)){
		$cart = $_SESSION['cart'];
	}else{
		$cart = array();
	}
	
	$productId = isset($_GET['product_id']) ? $_GET['product_id'] : '';
	if ($productId != '' && find_product($productId)){
		if (empty($cart)){
			$cart[$productId] = 1;
		}else{
			if (isset($cart[$productId])){
				$cart[$productId] += 1;
			}else{
				$cart[$productId] = 1;
			}			
		}
	}
	$_SESSION["cart"] = $cart;
?>
<html>
<head>
<title>Demo tích hợp giỏ hàng Bảo Kim</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Pragma" content="no-cache" /> 
<link href="/baokimdemo/css/style.css" rel="stylesheet" type="text/css" />
</head>
	<body>
	<div id="main">
		<h2>Danh sách sản phẩm trong giỏ hàng</h2>	
		<?php
			if (empty($cart)){
				echo '<h3>Giỏ hàng trống. Click vào <a href="index.php">đây </a>để mua hàng</h3>';
			} else{				
		?>
		<table width="100%" cellspacing="10px">
			<thead>
				<tr>
					<th>Tên sản phẩm</th>
					<th>Giá</th>
					<th>Số lượng</th>
					<th>Thành tiền</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$total_price = 0;	
				foreach ($cart as $product_id => $quantity):
					$product = find_product($product_id);
					$total_price += $product->price * $quantity;
				?>
				<tr>
					<td><?php echo $product->name;?></td>
					<td><?php echo $product->price;?></td>
					<td><?php echo $quantity;?></td>
					<td><?php echo $product->price * $quantity;?></td>					
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" align="right">Tổng tiền</td>
					<td><?php echo $total_price;?></td>
				</tr>
				<tr>
					<td colspan="3" ><a href="index.php">Tiếp tục mua hàng</a></td>
					<td>
						<a href="checkout.php"><img src="../images/btn_pay_now_3.png" border="0" title="Thanh toán an toàn qua Bảo Kim !" /></a>
					</td>
				</tr>
			</tfoot>			
		</table>
		<?php }?>
	</div>
	</body>
</html>