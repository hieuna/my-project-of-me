<?php /* Smarty version 2.6.19, created on 2012-04-22 17:51:24
         compiled from shopping_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'shopping_detail.tpl', 48, false),array('modifier', 'decode', 'shopping_detail.tpl', 59, false),array('modifier', 'default', 'shopping_detail.tpl', 60, false),array('modifier', 'selfUrl', 'shopping_detail.tpl', 77, false),array('modifier', 'encode', 'shopping_detail.tpl', 77, false),array('function', 'html_options', 'shopping_detail.tpl', 65, false),)), $this); ?>
<div class="pageDefault" id="capThanhtoan">
                <div class="pageTitle">THANH TOÁN</div>
                <div class="payProcess">
                        <div class="payLeft"></div>
                        <div class="payMid">
                        	<div class="stepNum02">1</div>
                            <span class="stepDesc">Chọn thanh toán</span>
                        </div>
                    	<div class="payArrow"></div>
                        <div class="payMid">
                        	<div class="stepNum">2</div>
                            <span class="stepDesc02">Nhập thông tin</span>
                        </div>
                    	<div class="payArrow"></div>
                        <div class="payMid">
                        	<div class="stepNum">3</div>
                            <span class="stepDesc">Nhập thông tin</span>
                        </div>
                    	<div class="payRight"></div>
                </div>
                
                <table cellpadding="0" cellspacing="0" class="buyDeal">
                	<col width="5%" /><col width="50%" /><col width="10%" /><col width="15%" /><col width="15%" />
                	<tr>
                    	<th>STT</th>
                    	<th>Thông tin chi tiết</th>
                    	<th>Số lượng</th>
                    	<th>Giá mua</th>
                    	<th>Thành tiền</th>
                    </tr>
                	<tr>
                    	<td>1</td>
                    	<td class="buyDealInfo"><?php echo $this->_tpl_vars['product']['Product_Name']; ?>
</td>
                    	<td>
                        	<select onchange="return Caculator(this,'<?php echo $this->_tpl_vars['product']['Product_DealPrice']; ?>
');" name="selNumber">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                            </select>
                        </td>
                    	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['Product_DealPrice'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
</td>
                    	<td><span id="totalhtml"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['Product_DealPrice']*1)) ? $this->_run_mod_handler('number_format', true, $_tmp) : smarty_modifier_number_format($_tmp)); ?>
</span></td>                        
                    </tr>
                </table>
                <div class="payBoxLeft">
                    <div class="payBoxLeftTitle">ĐĂNG KÝ  MUA HÀNG</div>
                    <form style="float:left;" name="frm" method="post" onsubmit="return CheckFormRegister(this);">
                    <input type="hidden" name="pmt_method" value="<?php echo $_GET['pmt_method']; ?>
" />
                    <input type="hidden" name="frmQuality" id="quality" value="1" />
                    <input type="hidden" name="frmTtotal" id="total" value="<?php echo $this->_tpl_vars['product']['Product_DealPrice']; ?>
" />
                    <input type="hidden" name="frmProductID" value="<?php echo $this->_tpl_vars['product']['Product_ID']; ?>
" />
                    <input type="hidden" name="frmPayType" value="<?php echo ((is_array($_tmp=$_GET['pmt_method'])) ? $this->_run_mod_handler('decode', true, $_tmp) : smarty_modifier_decode($_tmp)); ?>
" />
                        <input type="text" value="" class="formInput02 labelInput" id="Name" name="frmName" title="<?php echo ((is_array($_tmp=@$_SESSION['member']['name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Họ và tên') : smarty_modifier_default($_tmp, 'Họ và tên')); ?>
"><br />
                        <input type="text" value="" class="formInput02 labelInput" id="Email" name="frmEmail" title="<?php echo ((is_array($_tmp=@$_SESSION['member']['email'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Email của bạn') : smarty_modifier_default($_tmp, 'Email của bạn')); ?>
"><br />
                        <input type="text" value="" class="formInput02 labelInput" id="Name" name="frmPhone" title="<?php echo ((is_array($_tmp=@$_SESSION['member']['phone'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Điện thoại liên lạc') : smarty_modifier_default($_tmp, 'Điện thoại liên lạc')); ?>
"><br />
                        <select name="city" style="padding:2px 5px; margin-top:10px; width:295px; border:1px solid #CCC;">
                        <option value="">Chọn quận huyện giao hàng</option>
  <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['city'],'selected' => $this->_tpl_vars['contact']['type_id']), $this);?>

</select><br />
                        <textarea  class="formInput02 labelInput" id="Phone" name="frmAddress" title="<?php echo ((is_array($_tmp=@$_SESSION['member']['address'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Địa chỉ nhận hàng') : smarty_modifier_default($_tmp, 'Địa chỉ nhận hàng')); ?>
"></textarea><br />
                        <input value="" type="text" class="formInput02 labelInput" id="Capthcha" name="frmSecure" title="Mã số xác thực" style="width:160px;float:left"><img style="margin:12px 0 0 10px; border:1px solid #E96D5B; float:left" src="lib/captcha/captcha.class.php?width=100&height=40&characters=5" alt="Mã bảo mật" /><br />
                        <span class="forrmDesc">
                         <input type="checkbox" name="chekAccept" class="homeSignInCheck" id="chekAccept">&nbsp;Tôi đã xem và đồng ý với Quy định của <a href="quy-che.html" title="Xem quy định của ChungMua3HV.vn">chungmua3hv.vn</a>
                        </span><br />
                        <input type="submit" class="formBtn" value="Đăng ký">
                    </form>
				</div>
                <div class="payBoxRight">
                	Nếu bạn đã tạo tài khoản trên <b>chungmua3hv.vn</b> Hãy đăng nhập để mua hàng!
                    <a href="dang-nhap.html?url=<?php echo ((is_array($_tmp=((is_array($_tmp='')) ? $this->_run_mod_handler('selfUrl', true, $_tmp) : smarty_modifier_selfUrl($_tmp)))) ? $this->_run_mod_handler('encode', true, $_tmp) : smarty_modifier_encode($_tmp)); ?>
"></a>
                </div>
                <div class="clr"></div>
                <p></p>
                <div class="pageTitle">CHẤP NHẬN THANH TOÁN</div>
                <div class="payType">
                	<div class="payImage"><img src="themes/default/img/bank_1.gif" alt="photo" /></div>
                	<div class="payImage"><img src="themes/default/img/bank_2.gif" alt="photo" /></div>
                	<div class="payImage"><img src="themes/default/img/bank_3.gif" alt="photo" /></div>
                	<div class="payImage"><img src="themes/default/img/bank_4.gif" alt="photo" /></div>
                	<div class="payImage"><img src="themes/default/img/bank_5.gif" alt="photo" /></div>
                	<div class="payImage"><img src="themes/default/img/bank_6.png" alt="photo" /></div>
                	<div class="payImage"><img src="themes/default/img/bank_7.png" alt="photo" /></div>
                	<div class="payImage"><img src="themes/default/img/bank_9.png" alt="photo" /></div>
                	<div class="payImage"><img src="themes/default/img/bank_10.png" alt="photo" /></div>
                	<div class="payImage"><img src="themes/default/img/bank_11.png" alt="photo" /></div>
                	<div class="payImage"><img src="themes/default/img/bank_12.png" alt="photo" /></div>
                </div>
                <div class="clr"></div>
            </div>
            <?php echo '
            <script>
			$(document).ready(function(){ gotoTop(\'capThanhtoan\');});

			function Caculator(sel,price){
				var price= parseInt(price);
				var sel= parseInt(sel.value);
				var total = price*sel;
				$("#totalhtml").html(addCommas(total));
				$("#total").val(total);
				$("#quality").val(sel);
				return false;
			}
            function onBlur(object,type){
				if(object.value==\'\'){object.type=type;object.value=object.defaultValue}
			}
            function onFocus(object,type){
				object.type=type;if(object.value==object.defaultValue){object.value=\'\';}return true;
			}
			function CheckFormRegister(frm){
				
				if(frm.frmName.value==\'Họ và tên\'){
					alert("Xin vui lòng nhập tên bạn !");
						frm.frmName.focus();
						return false;
				}
				if(frm.frmEmail.value==\'Email của bạn\'){
					alert("Xin vui lòng nhập email !");
						frm.frmEmail.focus();
						return false;
				}
				if(frm.frmPhone.value==\'Điện thoại liên lạc\'){
					alert("Xin vui lòng nhập số điện thoại để chúng tôi liên hệ với bạn.");
						frm.frmPhone.focus();
						return false;
				}
				if(frm.city.value==\'\'){
					alert("Xin vui lòng chọn quận huyện.");
						frm.city.focus();
						return false;
				}
				if(frm.frmAddress.value==\'Địa chỉ nhận hàng\'){
					alert("Xin vui lòng nhập địa chỉ của bạn để chúng tôi có thể chuyển hàng cho bạn.");
						frm.frmAddress.focus();
						return false;
				}
				if(frm.frmSecure.value==\'Mã số xác thực\'){
					alert("Xin vui lòng nhập mã số xác thực để đảm bảo tính an toàn cho giao dịch của bạn.");
						frm.frmSecure.focus();
						return false;
				}
				if(document.getElementById(\'chekAccept\').checked==false){
					alert("Xin vui lòng tích vào Đồng ý với quy định của chúng tôi.");
						frm.chekAccept.focus();
						return false;
				}
			}
			function addCommas(nStr)
				{
					nStr += \'\';
					x = nStr.split(\'.\');
					x1 = x[0];
					x2 = x.length > 1 ? \'.\' + x[1] : \'\';
					var rgx = /(\\d+)(\\d{3})/;
					while (rgx.test(x1)) {
						x1 = x1.replace(rgx, \'$1\' + \',\' + \'$2\');
					}
					return x1 + x2;
				}			
            </script>
            '; ?>