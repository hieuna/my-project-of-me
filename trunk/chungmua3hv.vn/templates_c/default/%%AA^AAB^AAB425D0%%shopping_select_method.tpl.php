<?php /* Smarty version 2.6.19, created on 2012-04-17 01:32:02
         compiled from shopping_select_method.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encode', 'shopping_select_method.tpl', 41, false),)), $this); ?>
<div class="pageDefault" id="chonphuongthuc">
                <div class="pageTitle">CHỌN PHƯƠNG THỨC THANH TOÁN</div>
                <div class="payProcess">
                        <div class="payLeft"></div>
                        <div class="payMid">
                        	<div class="stepNum02">1</div>
                            <span class="stepDesc02">Chọn thanh toán</span>
                        </div>
                    	<div class="payArrow"></div>
                        <div class="payMid">
                        	<div class="stepNum">2</div>
                            <span class="stepDesc">Nhập thông tin</span>
                        </div>
                    	<div class="payArrow"></div>
                        <div class="payMid">
                        	<div class="stepNum">3</div>
                            <span class="stepDesc">Nhập thông tin</span>
                        </div>
                    	<div class="payRight"></div>
                </div>
                
                
                
                
                <div class="clr"></div>
                  <div class="clr"></div>
                    <p>Xin quý khách chọn phương thức thanh toán bằng cách click chuột vào phương thức nào mà bạn muốn.</p>

                <p></p>
                             
                <div class="method"  id="<?php echo ((is_array($_tmp='Thanh toán bằng Thẻ nội địa')) ? $this->_run_mod_handler('encode', true, $_tmp) : smarty_modifier_encode($_tmp)); ?>
">
                    <div class="pageTitle">Thanh toán bằng Thẻ ATM trực tuyến
    </div>
                    <div class="payType" style="margin-left:10px;">
                        <img  style="margin:5px;" src="upload/thanhtoan_11.png" alt="photo" />
                        <div class="clr"></div>
                        <span style="">Bao gồm các loại thẻ tín dụng, ghi nợ nội địa mang thương hiệu của các ngân hàng Việt Nam</span>
                        <p>Thanh toán trực tiếp cho <b>Công ty TNHH Thương Mại VHH Hà Nội</b></p>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="method"  id="<?php echo ((is_array($_tmp='Nộp tiền tại quầy ngân hàng')) ? $this->_run_mod_handler('encode', true, $_tmp) : smarty_modifier_encode($_tmp)); ?>
">
                    <div class="pageTitle">Nộp tiền tại quầy ngân hàng
    </div>
                    <div class="payType" style="margin-left:10px;">
                        <div style="margin:5px; float:left; width:150px; text-align:center" ><img  src="upload/bank.png"  width="60" alt="photo" /></div>
                        <div style=" margin-left:10px;">
                            <p>Thanh toán cho <b>Công ty TNHH Thương Mại VHH Hà Nội</b></p>
    				Thời gian hoàn thanh ngay lập tức
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
                
                                <div class="method"  id="<?php echo ((is_array($_tmp='Thanh toán bằng thẻ ATM')) ? $this->_run_mod_handler('encode', true, $_tmp) : smarty_modifier_encode($_tmp)); ?>
">
                    <div class="pageTitle">Thanh toán bằng thẻ ATM
    </div>
                    <div class="payType" style="margin-left:10px;">
                          <div style="margin:5px; float:left; width:150px; text-align:center" ><img  src="upload/atm.png"  width="90" alt="photo" /></div>
                        <div style=" margin-left:10px;">
                            <p>Thanh toán cho <b>Công ty TNHH Thương Mại VHH Hà Nội</b></p>
    						Thời gian hoàn thanh ngay lập tức
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
                
                <div class="method" id="<?php echo ((is_array($_tmp='Thanh toán bằng chuyển phát nhanh')) ? $this->_run_mod_handler('encode', true, $_tmp) : smarty_modifier_encode($_tmp)); ?>
">
                    <div class="pageTitle">Thanh toán bằng chuyển phát nhanh
    </div>
                    <div class="payType" style="margin-left:10px;">
                        <div class="clr"></div>
                          <div style="margin:5px; float:left; width:150px; text-align:center" ><img  src="upload/chuyen-phat-nhanh.jpg"  width="100" alt="photo" /></div>
                        <div style=" font-size:12px; margin-left:30px;"><p>Nhận hàng sau 2h đặt hàng</p>
   <p> Chỉ áp dụng nội thành Hà Nội</p> Phí vận chuyển : 30,000 đ</div>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="method" id="<?php echo ((is_array($_tmp='Thanh toán tại nhà')) ? $this->_run_mod_handler('encode', true, $_tmp) : smarty_modifier_encode($_tmp)); ?>
">
                    <div class="pageTitle">Thanh toán tại nhà
    </div>
                    <div class="payType" style="margin-left:10px;">
                        <div class="clr"></div>
                           <div style="margin:5px; float:left; width:150px; text-align:center" ><img  src="upload/tien_mat.jpg"  width="100" alt="photo" /></div>
                       <div style="font-size:12px; margin-left:30px;"><p>Chúng tôi sẽ xác nhận lại thông tin vận chuyển của quý khách và thỏa thuận phương thức vận chuyển</p>
                       Mọi thắc mắc xin gọi đường dây nóng: <b><?php echo $this->_config[0]['vars']['company_hotline']; ?>
 </b>
                       </div>
                    </div>
                    <div class="clr" id="tieptuc"></div>
                </div>
                    <div class="clr"></div>
                 
                      <div class="clr"></div>
              
            </div>
            
            <div class="pageDefault" style="margin-top:20px; min-height:0;">
                <div class="pageTitle">CÁCH THỨC MUA HÀNG</div>
                <div class="clr"></div>
                <p></p>
                <p>
                <img src="upload/payment.jpg" style="margin-left:10px;" /></p>
                <p></p>
                     <div class="clr"></div>
            </div>
<?php echo '
<script>
$(".method").click(
  function () {
    $(\'.method\').removeClass(\'method_selected\'); 
	var type= $(this).attr(\'id\');
	$("#pmt_method").val(type);
    $(this).addClass(\'method_selected\'); 
	document.location=\'pmt_order.php?pmt_method=\'+type+\'&pmt_ID='; ?>
<?php echo $_GET['ID']; ?>
<?php echo '\';
  }
);

</script>
'; ?>