<? 
include("lang.php");
require_once("../includes/inc_config.php");
ob_start("callback");
//die($_SESSION["city"]);
$act        =   getValue("act","str","GET","");
if($act == "logout"){
    if($_SESSION['loged'] == 1){       	
		unset($_SESSION['ses_email']);
		unset($_SESSION['ses_userid']); 
		unset($_SESSION['ses_username']); 
		unset	($_SESSION['loged']);
        redirect("../");
    }
}    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>

<div id="container">
<div id="cse" style="width: 50%;float:left;">Loading</div>
<script src="http://www.google.com.vn/jsapi" type="text/javascript"></script>
<script type="text/javascript"> 
  google.load('search', '1', {language : 'vi',style : google.loader.themes.MINIMALIST});
  google.setOnLoadCallback(function() {
    var customSearchOptions = {};
    var imageSearchOptions = {};
    imageSearchOptions['layout'] = google.search.ImageSearch.LAYOUT_POPUP;
    customSearchOptions['enableImageSearch'] = true;
    customSearchOptions['imageSearchOptions'] = imageSearchOptions;  var customSearchControl = new google.search.CustomSearchControl(
      '007446901747837198769:jquxxhlqkpm', customSearchOptions);
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    customSearchControl.draw('cse');
  }, true);
</script>
<link rel="stylesheet" href="http://www.google.com/cse/style/look/default.css" type="text/css" />	<SCRIPT Language=VBScript><!--
</div>
			
			<!-- End container-->
</body>
</html>