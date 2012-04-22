<?php /* Smarty version 2.6.19, created on 2012-04-22 17:32:51
         compiled from rightDisplay.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadModule', 'rightDisplay.tpl', 6, false),)), $this); ?>
<div id="pageRight">
        	<div class="viewSoldDeal">
            	<a href="san-pham-da-ban.html"><img src="themes/default/images/viewSoldDeals.gif" alt="photo"/></a>
            </div>
            <!--support-->
            <?php echo smarty_function_loadModule(array('name' => 'support'), $this);?>

<a href="http://www.smartnet.vn" target="_blank"  style="margin:0 0 5px" title="Khuyen mai thiet ke website Spa & Beauty Salon">
<img src="http://www.smartnet.vn/upload/thietkewebsitespa.gif" border="0" />
</a>
<div class="clr" style="margin:0 0 10px"></div>


        	<!--đang giảm giá-->    
            <?php echo smarty_function_loadModule(array('name' => 'product','task' => 'discount'), $this);?>
    
        	<!--tìm hiểu thêm-->
            <?php echo smarty_function_loadModule(array('name' => 'control','task' => 'learn'), $this);?>

        	
            <!--quảng cáo-->
            <?php echo smarty_function_loadModule(array('name' => 'advertisement','task' => 'adv'), $this);?>

        </div>
        <div class="clr"></div>