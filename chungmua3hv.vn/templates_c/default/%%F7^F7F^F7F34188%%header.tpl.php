<?php /* Smarty version 2.6.19, created on 2012-02-05 21:52:04
         compiled from header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'header.tpl', 6, false),array('modifier', 'selfUrl', 'header.tpl', 35, false),array('modifier', 'encode', 'header.tpl', 35, false),)), $this); ?>
<div id="pageHeader">

    	<a href="<?php echo @SITE_URL; ?>
" class="logo"><img src="themes/default/images/logo.png" alt="photo" /></a>
        <div class="cityMenu">
            <div class="cityName">
                <a href="<?php echo $this->_tpl_vars['city']['Group_Mark']; ?>
/" class="city"><?php echo ((is_array($_tmp=@$this->_tpl_vars['city']['Group_Name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Toàn Quốc') : smarty_modifier_default($_tmp, 'Toàn Quốc')); ?>
</a>
                <ul class="dropDown">
               <?php $_from = $this->_tpl_vars['destination']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    <li><a href="<?php echo $this->_tpl_vars['item']['Group_Mark']; ?>
/"><?php echo $this->_tpl_vars['item']['Group_Name']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
                </ul>   
            </div> 
            <p>Chọn địa điểm khác</p>
        </div>
        
        <div class="listMenu">
            <div class="listName">
            <?php if ($this->_tpl_vars['cate']): ?>
                <a href="<?php echo $this->_tpl_vars['cate']['Group_Mark']; ?>
.html" class="list"><?php echo ((is_array($_tmp=@$this->_tpl_vars['cate']['Group_Name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Danh mục sản phẩm') : smarty_modifier_default($_tmp, 'Danh mục sản phẩm')); ?>
</a><?php else: ?>
                <a class="list">Danh mục sản phẩm</a>
             <?php endif; ?>
                <ul class="cate_dropDown">
                <?php unset($this->_sections['foo']);
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['category']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
$this->_sections['foo']['step'] = 1;
$this->_sections['foo']['start'] = $this->_sections['foo']['step'] > 0 ? 0 : $this->_sections['foo']['loop']-1;
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = $this->_sections['foo']['loop'];
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>
                    <li><a href="<?php echo $this->_tpl_vars['category'][$this->_sections['foo']['index']]['Group_Mark']; ?>
.html"><?php echo $this->_tpl_vars['category'][$this->_sections['foo']['index']]['Group_Name']; ?>
</a></li>
				<?php endfor; endif; ?>
                </ul>   
            </div> 
        </div>
        
        <!-- SIGNIN -->
        <div class="homeSignIn">
        <?php if ($_SESSION['_user']['ID']): ?>
        		<img src="<?php if ($_SESSION['member']['avatar']): ?> upload/avatar/<?php echo $_SESSION['member']['avatar']; ?>
 <?php else: ?>themes/default/images/ava.png<?php endif; ?>" alt="photo" width="35" height="35" />
                <div style="float:left; margin:8px 0 0 10px">
                <div class="username">Chào mừng<b> <?php echo $_SESSION['_user']['Name']; ?>
 !</b>&nbsp;&nbsp;|</div><a class="bntLogout" href="javascript:void(0)" onclick="return memberLogOut('<?php echo ((is_array($_tmp=((is_array($_tmp="")) ? $this->_run_mod_handler('selfUrl', true, $_tmp) : selfUrl($_tmp)))) ? $this->_run_mod_handler('encode', true, $_tmp) : smarty_modifier_encode($_tmp)); ?>
')">Thoát [ x ]</a> 
                <div style="clear:both;"></div>
                <div class="listAccount">
                    <div class="listAccountz">
                        <a href="<?php echo $this->_tpl_vars['cate']['Group_Mark']; ?>
.html" class="list">Quản lý tài khoản</a>
                        <ul class="account_dropDown">
                            <li><a href="doi-mat-khau.html">Đổi mật khẩu</a></li>
                            <li><a title="Kiểm tra đơn hàng" href="theo-doi-don-hang.html">Kiểm tra đơn hàng</a></li>
                            <li><a href="sua-thong-tin-ca-nhan.html">Sửa thông tin cá nhân</a></li>
                        </ul>   
                    </div> 
                </div>
                </div>
        <?php else: ?>
            <form action="dang-nhap.html" method="post">
            <input type="hidden" name="url" value="<?php echo ((is_array($_tmp=((is_array($_tmp='')) ? $this->_run_mod_handler('selfUrl', true, $_tmp) : selfUrl($_tmp)))) ? $this->_run_mod_handler('encode', true, $_tmp) : smarty_modifier_encode($_tmp)); ?>
" />
            <input type="hidden" name="logintype" value="1" />
                <input type="text" class="homeSignInText labelInput" id="EMail" name="email" title="<?php if ($_COOKIE['logemail']): ?><?php echo $_COOKIE['logemail']; ?>
<?php else: ?>Email đăng nhập<?php endif; ?>" value="<?php echo $_COOKIE['logemail']; ?>
">
                <input type="password" name="password" class="homeSignInText" value="Mật khẩu" onclick="this.value=''">

                <input type="submit" class="homeSignInBtn" value="">
                <div class="clr"></div>
                      <div class="homeSignInExtra">
                        <input type="checkbox" name="customer_save_login" class="homeSignInCheck" id="customer_save_login" style="float:left">
                        <div class="homeSignInDesc">
                            <label class="signinNoteLabel" for="customer_save_login">Ghi nhớ</label> |<a title="Click vào đây nếu bạn quên mật khẩu." href="quen-mat-khau.html">Quên mật khẩu</a>|<a href="dang-ky-thanh-vien.html" title="Đăng ký thành viên">Đăng ký</a>

                        </div>
                    </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
    <!-- TOPNAV -->
    <div class="headerNav">
        <div class="topNav">
            <a title="Đăng ký nhận email khuyến mại từ website" onclick="return buydeal(this);" href="dang-ky-nhan-khuyen-mai.html?size=300x130" rel="nofollow" id="popupHtmlDealsBuy" class="regEmailBtn"><span>Đăng ký nhận Email</span><span class="ico"><img src="themes/default/images/icoEmail.png" alt="photo"/></span></a>

            <a href="theo-doi-don-hang.html" title="Theo dõi đơn hàng của bạn" class="followOderBtn"><span>Theo dõi đơn hàng</span><span class="ico"><img src="themes/default/images/icoFollowOder.png" alt="Theo dõi đơn hàng"/></span></a>
        </div>
        <div class="headerNavExtra">
            <a href="ymsgr:sendIM?<?php echo $this->_config[0]['vars']['company_support']; ?>
" class="icoTalk">Hỗ trợ trực tuyến</a>
            <span class="icoPhone"><b>Hotline:</b> <?php echo $this->_config[0]['vars']['company_hotline']; ?>
 </span>
        </div>

    </div>
    
    <div class="clr" style="margin-top:35px">
    	 
    	<a href="https://www.baokim.vn/payment_guide/chungmua3hvvndeal.html" target="_blank"><img src="themes/default/images/mua-deal-chungmua3hv.gif" border="0" /></a>
    
    </div>
    
    <div class="topMenu" style="margin-top:2px">
   		<div class="right">
   		<ul>
             <?php unset($this->_sections['foo']);
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['category']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['max'] = (int)7;
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['show'] = true;
if ($this->_sections['foo']['max'] < 0)
    $this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
$this->_sections['foo']['step'] = 1;
$this->_sections['foo']['start'] = $this->_sections['foo']['step'] > 0 ? 0 : $this->_sections['foo']['loop']-1;
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = min(ceil(($this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] - $this->_sections['foo']['start'] : $this->_sections['foo']['start']+1)/abs($this->_sections['foo']['step'])), $this->_sections['foo']['max']);
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>
                <li><a href="<?php echo $this->_tpl_vars['category'][$this->_sections['foo']['index']]['Group_Mark']; ?>
.html" <?php if ($_GET['DID'] == $this->_tpl_vars['category'][$this->_sections['foo']['index']]['Group_Mark']): ?> class="selected"<?php endif; ?>><?php echo $this->_tpl_vars['category'][$this->_sections['foo']['index']]['Group_Name']; ?>
</a></li>
            <?php endfor; endif; ?>
        </ul>
        </div>
   </div>