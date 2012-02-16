<?php /* Smarty version 2.6.10, created on 2012-01-11 18:04:26
         compiled from D:%5CAppServ%5Cwww%5Cmobimart/templates/hotdeal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'D:\\AppServ\\www\\mobimart/templates/hotdeal.tpl', 24, false),array('modifier', 'number_format', 'D:\\AppServ\\www\\mobimart/templates/hotdeal.tpl', 49, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" href="css/hotdeal.css" type="text/css" />
        <link rel="stylesheet" href="css/css3.css" type="text/css" />
        <script src="js/jquery-1.7.min.js" type="text/javascript"></script>
        <script src="includes/js/count.js" type="text/javascript"></script>
        <title>Hot Deal</title>
    </head>
    <body>
    	<div id="main-hotdeal" class="clearfix">
    		<div id="top">
    			<div class="name">
    				Điện thoại <b>| <?php echo $this->_tpl_vars['page_title']; ?>
</b>
    			</div>
    			<div class="contact">Liên hệ mua hàng: <b>012-77-73-73-73</b></div>
    		</div>
    		<div class="rows clearfix">
    			<?php $_from = $this->_tpl_vars['lsHotDeal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['stt'] => $this->_tpl_vars['hotdeals']):
?>
    			<div class="cols">
    				<div class="title_hotdeal">
    					<div class="date_time">Cập nhật: <?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['start_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M:%S") : smarty_modifier_date_format($_tmp, "%H:%M:%S")); ?>
, ngày <?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['start_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
 | Lượt xem: 500</div>
    					<div class="clearfix"></div>
    					<div class="namesp">
    						<a href="#"><?php echo $this->_tpl_vars['hotdeals']['title']; ?>
</a>
    					</div>
    				</div>
    				<div class="box-hotdeal">
    					<div class="box_title_hotdeal">Hot-Deal</div>
    					<div class="giam_gia"><?php echo $this->_tpl_vars['hotdeals']['discount']; ?>
%</div>
    					<div class="hangsx"><?php if ($this->_tpl_vars['hotdeals']['image_cat'] == ""): ?> <img src="image/<?php echo $this->_tpl_vars['hotdeals']['image_cat']; ?>
" /> <?php else: ?> <?php echo $this->_tpl_vars['hotdeals']['name_cat'];  endif; ?></div>
    					<div class="box-image">
	    					<a href="#">
	    						<img src="image/<?php echo $this->_tpl_vars['hotdeals']['imagesp']; ?>
" />
	    					</a>
	    					<div class="feauture"><?php echo $this->_tpl_vars['hotdeals']['title_feauture']; ?>
</div>
	    					<div class="box_tinh_nang">
	    						<img src="images/tinh_nang.jpg" />
	    					</div>
    					</div>
    				</div>
    				<div class="desciption">
    					<?php echo $this->_tpl_vars['hotdeals']['description']; ?>

    				</div>
    				<div class="all_price">
    					<div class="price">
    						<h2><?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['price_hotdeal'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 <span>VNĐ</span></h2>
    						<span class="price_others">Giá niêm yết: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 đ </b>| Mức giảm: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['muc_giam'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 đ</b></span>
    					</div>
    					<div class="kham_pha">
    						<input type="button" class="button" value="Khám phá" />
    					</div>
    					<div class="clearfix"></div>
    					<div class="thong_ke">
    						<div class="buy">Đã mua: <b>5/15</b> | Danh sách</div>
    						<div class="time" id="clock">Thời gian còn lại: <b><span id="days"></span> ngày, <span id="hours"></span>h : <span id="minutes"></span> : <span id="seconds"></span></b></div>
    					</div>
    				</div>
    				<div class="box_end">
    					<div class="lsbutton">
    						<input type="button" class="bt_loantin" value="Loan tin" />
    						<input type="button" class="bt_number" value="500" />
    					</div>
    					<div class="lstext">
    						Bấm loan tin đến bạn bè để nhận <b>500đ</b> từ xtech.vn<br />
    						<div>[<a href="#">tài khoản tiền thưởng của bạn</a>] [<a href="#">cách dùng tiền thưởng</a>]</div>
    					</div>
    				</div>
    			</div>
    			<script type="text/javascript" charset="utf-8">
    			thisDate = '<?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['end_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y/%m/%d") : smarty_modifier_date_format($_tmp, "%Y/%m/%d")); ?>
';
    			thisID = <?php echo $this->_tpl_vars['hotdeals']['id']; ?>
+1;
    			<?php echo '
				 $(function() {
				 // ***** thay 2011/01/01 là năm  tháng ngày *************************     
				 	$(\'div#clock\').countdown(thisDate , function(event) {
					 var $this = $(this);
						 switch(event.type) {
							 case "seconds":
							 case "minutes":
							 case "hours":
							 case "days":
							 case "weeks":
							 case "daysLeft":
							 $this.find(\'span#\'+event.type).html(event.value);
							 break;
							 case "finished":
							 $this.hide();
							 break;
						 }
					 });
				 });
				 '; ?>

				</script>
				<?php echo $this->_tpl_vars['hotdeals']['stt']; ?>

				
    			<?php endforeach; endif; unset($_from); ?>
    		</div>
    	</div>
    </body>
</html>