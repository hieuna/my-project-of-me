<?php /* Smarty version 2.6.19, created on 2011-09-17 00:37:17
         compiled from frm_report.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'decode', 'frm_report.tpl', 9, false),array('modifier', 'default', 'frm_report.tpl', 9, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>THÔNG BÁO - CHUNGMUA3HV.VN</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta content="INDEX,FOLLOW" name="robots" />
<meta http-equiv="refresh" content="1;url=<?php echo ((is_array($_tmp=((is_array($_tmp=$_GET['url'])) ? $this->_run_mod_handler('decode', true, $_tmp) : smarty_modifier_decode($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @SITE_URL) : smarty_modifier_default($_tmp, @SITE_URL)); ?>
">
<base href="<?php echo @SITE_URL; ?>
" />
<meta name="copyright" content="SmartNet Media Co.,Ltd" />
<meta name="author" content="SmartNet Media Co.,Ltd" />
<meta http-equiv="audience" content="General" />
<meta name="resource-type" content="Document" />
<meta name="distribution" content="Global" />
<link rel="shortcut icon" href="favicon.png" type="image/x-icon" /> 
<meta name="revisit-after" content="1 days" />
<meta name="GENERATOR" content="SmartNet Media Co.,Ltd" />
<link rel="stylesheet" type="text/css" href="themes/default/site.css" media="screen" />
<link rel="stylesheet" type="text/css" href="themes/default/addon.css" media="screen" />
<link rel="stylesheet" type="text/css" href="themes/default/popup.css" media="screen" />
<script src="themes/default/js/jquery-1.4.2.min.js"></script>
<body>
<div class="bgBody">
<div class="all">
  <div class="boxReport">
 	<div class="frmReport">
    	<h2>THÔNG BÁO</h2>
        <div class="contentReport">
        	<?php if ($_GET['msg']): ?><?php echo ((is_array($_tmp=$_GET['msg'])) ? $this->_run_mod_handler('decode', true, $_tmp) : smarty_modifier_decode($_tmp)); ?>
<?php else: ?>Xin vui lòng đợi. Hệ thống sẽ tự động chuyển tới trang chủ...<?php endif; ?>
            <p>Nếu bạn chờ quá lâu. Xin hãy click <a style=" text-decoration:underline" title="Click vào đây" href="<?php echo ((is_array($_tmp=((is_array($_tmp=$_GET['url'])) ? $this->_run_mod_handler('decode', true, $_tmp) : smarty_modifier_decode($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @SITE_URL) : smarty_modifier_default($_tmp, @SITE_URL)); ?>
">vào đây</a></p>
            <p><img src="upload/loading.gif" /></p>
        </div>
    </div>
  </div>
  
    <div class ="clr"></div>
</div>
</div>
</body>
</html>