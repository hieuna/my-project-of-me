<?php /* Smarty version 2.6.10, created on 2012-02-11 10:16:29
         compiled from D:/AppServ/www/mobimart/templates/hotdeal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'D:/AppServ/www/mobimart/templates/hotdeal.tpl', 27, false),array('modifier', 'number_format', 'D:/AppServ/www/mobimart/templates/hotdeal.tpl', 92, false),)), $this); ?>
    	<div id="main-hotdeal" class="clearfix">
    		<!--  
    		<div id="top">
    			<div class="name">
    				Điện thoại <b>| <?php echo $this->_tpl_vars['page_title']; ?>
</b>
    			</div>
    			<div class="contact">Liên hệ mua hàng: <b>012-77-73-73-73</b></div>
    		</div>
    		-->
    		<div class="rows clearfix">
	    		<div id="slideshow">
	    		<ul>
	    		<?php $_from = $this->_tpl_vars['oBanner']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['stt'] => $this->_tpl_vars['banner']):
?>
	    			<li>
	    			<a href="<?php echo $this->_tpl_vars['banner']['banner_url']; ?>
" target="_blank">
	    				<img src="<?php echo $this->_tpl_vars['banner']['banner_image']; ?>
" />
	    			</a>
	    			</li>
	    		<?php endforeach; endif; unset($_from); ?>
	    		</ul>
	    		</div>
    		</div>
    		<div class="rows clearfix">
    			<?php $_from = $this->_tpl_vars['lsHotDeal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['stt'] => $this->_tpl_vars['hotdeals']):
?>
    			<div class="cols"<?php if ($this->_tpl_vars['hotdeals']['stt']%2 == 0):  else: ?> style="margin-right:0; float:right;"<?php endif; ?>>
    				<div class="title_hotdeal">
    					<div class="date_time">Cập nhật: Ngày <?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['start_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
,  <?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['start_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['config']['time']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['config']['time'])); ?>
| Lượt xem: <?php echo $this->_tpl_vars['hotdeals']['view']; ?>
</div>
    					<div class="clearfix"></div>
    					<div class="namesp">
    						<a href="index.php?route=product/product&product_id=<?php echo $this->_tpl_vars['hotdeals']['product_id']; ?>
"><?php echo $this->_tpl_vars['hotdeals']['title']; ?>
</a>
    					</div>
    				</div>
    				<div class="box-hotdeal">
    					<?php if ($this->_tpl_vars['hotdeals']['image'] == ""): ?>
    					<!--<div class="box_title_hotdeal">Hot-Deal</div>-->
    					<div class="giam_gia"><?php echo $this->_tpl_vars['hotdeals']['discount']; ?>
%</div>
    					<div class="hangsx"><?php if ($this->_tpl_vars['hotdeals']['image_cat'] == ""): ?> <?php echo $this->_tpl_vars['hotdeals']['name_cat']; ?>
 <?php else: ?> <?php echo $this->_tpl_vars['hotdeals']['name_cat'];  endif; ?></div>
    					<div class="box-image">
	    					<a href="index.php?route=product/product&product_id=<?php echo $this->_tpl_vars['hotdeals']['product_id']; ?>
">
	    						<img src="image/<?php echo $this->_tpl_vars['hotdeals']['imagesp']; ?>
" class="not_full" />
	    					</a>
	    					<div class="feauture"><?php echo $this->_tpl_vars['hotdeals']['title_feauture']; ?>
</div>
	    					<div class="box_tinh_nang">
	    						<img src="images/tinh_nang.jpg" />
	    					</div>
    					</div>
    					<?php else: ?>
    						<!--<div class="box_title_hotdeal">Hot-Deal</div>-->
    						<div class="giam_gia"><?php echo $this->_tpl_vars['hotdeals']['discount']; ?>
%</div>
    						<a href="index.php?route=product/product&product_id=<?php echo $this->_tpl_vars['hotdeals']['product_id']; ?>
">
    							<img src="<?php echo $this->_tpl_vars['hotdeals']['image']; ?>
" class="full" />
    						</a>
    					<?php endif; ?>
    					<div class="lsInfomation">
    						<div class="title_info">Tính năng nổi bật</div>
    						<div class="content_info">
    							<!--  
    							<ul>
								<?php $_from = $this->_tpl_vars['hotdeals']['ft']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['foo']):
?>
								    <?php if ($this->_tpl_vars['foo'] != ""): ?><li><?php echo $this->_tpl_vars['foo']; ?>
</li><?php endif; ?>
								<?php endforeach; endif; unset($_from); ?>
								</ul>
								-->
								<?php echo $this->_tpl_vars['hotdeals']['description']; ?>

    						</div>
    						<div class="ct_info ct_info_bgnone">
    							<ul style="float:left; margin-left: 120px;">
    								<li class="icon" style="padding-right: 0px;"><a href="http://www.facebook.com/xtechonline?ref=tn_tnmn"><img src="images/facebook.jpg" height="15" border="0" /></a></li>
    								<li class="icon" style="padding-right: 0px;"><a href="https://plus.google.com/u/0/113079457263731184385/posts#113079457263731184385/posts"><img src="images/google.jpg" height="15" border="0" /></a></li>
    								<li class="icon" style="padding-right: 0px;"><a href="http://twitter.com/#!/xtechonline1"><img src="images/switter.jpg" height="15" border="0" /></a></li>
    							</ul>
    							<ul style="float:right; margin-right: 10px;">
    								<li class="icon"><a href="index.php?route=product/product&product_id=<?php echo $this->_tpl_vars['hotdeals']['product_id']; ?>
"><img src="images/detail.jpg" width="95" border="0" /></a></li>
    							</ul>
    						</div>
    						<div class="ct_info">
    							<ul class="clearfix">
    								<li>Nhân viên bán hàng : <span><?php echo $this->_tpl_vars['hotdeals']['ct_name']; ?>
</span></li>
    							</ul>
    							<ul>	
    								<li class="icon"><img vspace="5" src="images/icon-phone.png" border="0" /><span class="bluper"><?php echo $this->_tpl_vars['hotdeals']['ct_phone']; ?>
</span></li>
    								<li class="icon"><a href="ymsgr:sendim?<?php echo $this->_tpl_vars['hotdeals']['ct_yahoo']; ?>
" title="<?php echo $this->_tpl_vars['hotdeals']['ct_yahoo']; ?>
"><img vspace="5" src="images/icon-yahoo.png" border="0" /><span><?php echo $this->_tpl_vars['hotdeals']['ct_yahoo']; ?>
</span></a></li>
    								<li class="icon"><a href="skype:<?php echo $this->_tpl_vars['hotdeals']['ct_skype']; ?>
?chat" title="<?php echo $this->_tpl_vars['hotdeals']['ct_skype']; ?>
"><img vspace="5" src="images/icon-skype.png" border="0" /><span><?php echo $this->_tpl_vars['hotdeals']['ct_skype']; ?>
</span></a></li>
    							</ul>
    						</div>
    					</div>
    				</div>
    				<div class="desciption">
    				</div>
    				<div class="all_price">
    					<div class="price">
    						<h2><?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['price_hotdeal'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 <span>VNĐ</span></h2>
    						<span class="price_others">Giá niêm yết: <b><?php if ($this->_tpl_vars['hotdeals']['price_ny'] == 0): ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 đ  <?php else:  echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['price_ny'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 đ <?php endif; ?></b>| Mức giảm: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['muc_giam'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
 đ</b></span>
    					</div>
    					<div class="kham_pha">
    						<input type="button" class="button" value="Khám phá" onclick="javascript:document.location.href='index.php?route=product/product&product_id=<?php echo $this->_tpl_vars['hotdeals']['product_id']; ?>
'" />
    					</div>
    					<div class="clearfix"></div>
    					<div class="thong_ke">
    						<div class="buy">Đã mua: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['da_mua'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['count'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</b> | <?php if ($this->_tpl_vars['hotdeals']['da_mua'] == 0): ?>Danh sách<?php else: ?><a href="javascript:void(0);" id="hd_<?php echo $this->_tpl_vars['hotdeals']['id']; ?>
">Danh sách</a><?php endif; ?></div>
    						<div class="time" id="clock_<?php echo $this->_tpl_vars['hotdeals']['id']; ?>
">Thời gian còn lại: <b><span id="days_<?php echo $this->_tpl_vars['hotdeals']['id']; ?>
"></span> ngày, <span id="hours_<?php echo $this->_tpl_vars['hotdeals']['id']; ?>
"></span>h : <span id="minutes_<?php echo $this->_tpl_vars['hotdeals']['id']; ?>
"></span> : <span id="seconds_<?php echo $this->_tpl_vars['hotdeals']['id']; ?>
"></span></b></div>
    						<div class="lsCustomer" id="cus_<?php echo $this->_tpl_vars['hotdeals']['id']; ?>
"></div>
    					</div>
    				</div>
    				<!--  
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
    				-->
    			</div>
    			<script type="text/javascript">
    			<?php echo '
				$(function() {
				 	// ***** thay 2011/01/01 là năm  tháng ngày *************************     
				 	$(\'div#clock_\'+';  echo $this->_tpl_vars['hotdeals']['id'];  echo ').countdown('; ?>
'<?php echo ((is_array($_tmp=$this->_tpl_vars['hotdeals']['end_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y/%m/%d") : smarty_modifier_date_format($_tmp, "%Y/%m/%d")); ?>
'<?php echo ' , function(event) {
					 var $this = $(this);
						 switch(event.type) {
							 case "seconds":
							 case "minutes":
							 case "hours":
							 case "days":
							 case "weeks":
							 case "daysLeft":
							 $this.find(\'span#\'+event.type+\'_\'+';  echo $this->_tpl_vars['hotdeals']['id'];  echo ').html(event.value);
							 break;
							 case "finished":
							 $this.hide();
							 break;
						 }
					 });
					 /* slideshow */
					$(function() {
						$(\'#slideshow ul\').cycle({
					        fx:     \'fade\',
					        timeout: 5000,
					        pager:  \'#page_slide\',
					        pagerAnchorBuilder: function(idx, slide) { 
					            return \'<a href="#"><span>\' + idx + \'</span></a>\'; 
					        },
					        before: function (curr, next, opts){
					        	var bgColor = $(next).attr(\'rel\');
					        	if (bgColor!=null) $(\'#bgslide\').animate({backgroundColor: bgColor});
					        }
					    });
					});		 
				});
				'; ?>

				</script>
				<?php if ($this->_tpl_vars['hotdeals']['stt'] != 0): ?>
				<div class="clrFixBorder"></div>
				<?php endif; ?>
    			<?php endforeach; endif; unset($_from); ?>
    		</div>
    	</div>