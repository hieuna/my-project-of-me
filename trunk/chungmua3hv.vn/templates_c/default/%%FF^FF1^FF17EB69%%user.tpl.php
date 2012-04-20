<?php /* Smarty version 2.6.19, created on 2011-09-17 00:48:39
         compiled from user.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadModule', 'user.tpl', 1, false),)), $this); ?>
<?php echo smarty_function_loadModule(array('name' => 'user','task' => $_GET['task']), $this);?>
