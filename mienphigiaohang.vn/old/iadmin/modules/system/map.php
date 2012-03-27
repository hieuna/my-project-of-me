<?php session_start();

	
	include('../../../includes/config.php');
	

?>
<script src="http://<?php echo $config['domain'];?>/iadmin/templates/js/jquery-1.4.2.min.js" type="text/javascript"></script>

  
 			 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
 			 <script src="http://<?php echo $config['domain'];?>/iadmin/templates/js/map.js"></script>
	 			<form  action="" name="adminForm" id="adminForm" > 
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			<input type="hidden" name="lat" id="lat" value="0" />
			<input type="hidden" name="long" id="long" value="0" />
			<input type="hidden" name="default_gmap_address" id="default_gmap_address" value="<?php echo $_REQUEST['value'];?>" />
			<div>
				<div id="load_gmap"	style="width: 490px; height: 300px; border: 1px solid #cdcdcd; margin: 0 auto;"></div>
			</div>
			</form>
