<?php /* Smarty version 2.6.19, created on 2011-10-14 23:38:18
         compiled from info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadModule', 'info.tpl', 3, false),)), $this); ?>
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
            <!--Phan noi dung-->
            <?php echo smarty_function_loadModule(array('name' => 'info','task' => $_GET['task']), $this);?>

        </div>
<!--RIGHT-->        
       <?php echo smarty_function_loadModule(array('name' => 'control','task' => 'right'), $this);?>

    <!--ket thuc #pageContent-->
    </div>
    <!-- FOOTER-->
    <?php echo smarty_function_loadModule(array('name' => 'footer'), $this);?>

    <div class ="clr"></div>
</div>
</div>
</body>
</html>