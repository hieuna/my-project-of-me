<?php /* Smarty version 2.6.19, created on 2011-09-17 00:36:28
         compiled from account.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadModule', 'account.tpl', 3, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php echo smarty_function_loadModule(array('name' => 'control','task' => 'css'), $this);?>

<body>
<div class="bgBody">
<div class="all">
    <!-- HEADER-->
    <?php echo smarty_function_loadModule(array('name' => 'header'), $this);?>

    <!-- CONTENT-->
    <div id="pageContent">
    	<div id="pageLeft">
         	<div class="pageDefault">               
           <!--Phan noi dung-->
            <?php echo smarty_function_loadModule(array('name' => 'account','task' => $_GET['task']), $this);?>

        </div>
        </div>
<!--RIGHT-->        
<div id="pageRight">
        	
        	<!--tìm hiểu thêm-->
        	<div class="boxRight">
            	<div class="boxTitle">
                	Tìm hiểu thêm
                </div>
                <div class="boxDiscount">

                	<ul>
                    	<li class="question">
                        	<div class="helpIcon">Vì sao được giá rẻ ?</div>
                        	<div class="helpContent">Groupon là hình thức nhiều người cùng mua 1 sản phẩm/dịch vụ trong 1 thời gian quy định để được hưởng giá ưu đãi.</div>
                        </li>
                    	<li class="online">
                        	<div class="helpIcon">Bạn phải thanh toán online thông qua:</div>

                        	<div class="helpContent">1. Thẻ Visa, Master<br />2. Thẻ ATM có đăng ký dịch vụ internet banking với ngân hàng</div>
                        </li>
                    	<li class="cast">
                        	<div class="helpIcon">Thanh toán bằng tiền mặt:</div>
                        	<div class="helpContent">1. Chuyển khoản qua cây ATM/nộp tại ngân hàng và báo lại cho chungmua3hv.vn<br />2. Chuyển khoản trực tuyến qua internet banking</div>
                        </li>

                    </ul>
                </div>
            </div>
            <!--quảng cáo-->
        </div>
        <div class="clr"></div>    <!--ket thuc #pageContent-->
    </div>
    <!-- FOOTER-->
    <?php echo smarty_function_loadModule(array('name' => 'footer'), $this);?>

    <div class ="clr"></div>
</div>
</div>
</body>
</html>